import { User } from "@prisma/client";
import { prismaClient } from "../app/database";
import {
  AdminRegisterRequest,
  // AdminLoginRequest,
  // AdminRecoveryRequest,
  AdminUpdateRequest,
  AdminResponse,
  toAdminResponse,
} from "../models/admin-model";
import { AdminValidation } from "../validations/admin-validation";
import { Validation } from "../validations/validation";
import bcrypt from "bcrypt";
import { v4 as uuid } from "uuid";
import { ResponseError } from "../errors/response-error";

export class AdminService {
  static async register(request: AdminRegisterRequest): Promise<AdminResponse> {
    const registerRequest = Validation.validate(
      AdminValidation.REGISTER,
      request
    ); // validation

    const existingAdmin = await prismaClient.user.findFirst({
      where: {
        OR: [
          { email: registerRequest.email },
          { username: registerRequest.username },
        ],
      },
    }); // check if email or username already exists
    if (existingAdmin) {
      throw new ResponseError(
        400,
        existingAdmin.email === registerRequest.email
          ? "Email already exists"
          : "Username already exists"
      );
    }

    registerRequest.password = await bcrypt.hash(registerRequest.password, 10); // hash password

    const admin = await prismaClient.user.create({
      data: {
        email: registerRequest.email,
        username: registerRequest.username,
        password: registerRequest.password,
        role: "ADMIN",
        admin: {
          create: {},
        },
      },
    });
    return toAdminResponse(admin); // push to database
  }

  // static async login(
  //   request: AdminLoginRequest
  // ): Promise<AdminResponse> {

  //   const loginRequest = Validation.validate(
  //     AdminValidation.LOGIN,
  //     request
  //   );

  //   let loginAdmin = await prismaClient.user.findFirst({
  //     where: {
  //       OR: [
  //         { email: loginRequest.E_Name },
  //         { username: loginRequest.E_Name }
  //       ],
  //     },
  //   });

  //   const errorMessage = "Email or Username or Password is Incorrect!";
  //   if (!loginAdmin) {
  //     throw new ResponseError(400, errorMessage); // not found
  //   }
  //   if (loginAdmin.email !== loginRequest.E_Name &&
  //       loginAdmin.username !== loginRequest.E_Name
  //   ) {
  //     throw new ResponseError(400, errorMessage); // check sensitive
  //   }

  //   const isValidPassword = await bcrypt.compare(
  //     loginRequest.password,
  //     loginAdmin.password
  //   );
  //   if (!isValidPassword) {
  //     throw new ResponseError(400, "Password is Incorrect!");
  //   }

  //   loginAdmin = await prismaClient.user.update({
  //     where: { id: loginAdmin.id },
  //     data: { token: uuid() },
  //   });
  //   return toAdminResponse(loginAdmin);
  // }

  static async logout(user: User): Promise<AdminResponse> {
    let admin = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!admin) {
      throw new ResponseError(404, "Admin not found");
    }

    admin = await prismaClient.user.update({
      where: { id: admin.id },
      data: { token: null },
    });
    return toAdminResponse(admin);
  }

  // static async recoveryPassword(
  //   request: AdminRecoveryRequest
  // ): Promise<AdminResponse> {

  //   const recoveryRequest = Validation.validate(
  //     AdminValidation.RECOVERY,
  //     request
  //   );

  //   let recoveryAdmin = await prismaClient.user.findFirst({
  //     where: {
  //       email: recoveryRequest.email,
  //       username: recoveryRequest.username,
  //     },
  //   });

  //   const errorMessage = "Email or Username is Incorrect!";
  //   if (!recoveryAdmin) {
  //     throw new ResponseError(400, errorMessage);
  //   }
  //   if (recoveryAdmin.email !== recoveryRequest.email &&
  //     recoveryAdmin.username !== recoveryRequest.username
  //   ) {
  //     throw new ResponseError(400, errorMessage);
  //   }

  //   recoveryAdmin = await prismaClient.user.update({
  //     where: { id: recoveryAdmin.id },
  //     data: { recoveryToken: uuid() },
  //   });
  //   return toAdminResponse(recoveryAdmin);
  // }

  // static async resetPassword(
  //   request: {
  //     password: string;
  //     newPassword: string;
  //     recoveryToken: string;
  //   }
  // ): Promise<AdminResponse> {

  // const resetRequest = Validation.validate(
  //   AdminValidation.RESET,
  //   request
  // );

  //   let resetAdmin = await prismaClient.user.findFirst({
  //     where: { recoveryToken: resetRequest.recoveryToken },
  //   });
  //   if (!resetAdmin) {
  //     throw new ResponseError(400, "Token is invalid!");
  //   }
  //   if (resetRequest.password !== resetRequest.newPassword) {
  //     throw new ResponseError(400, "Passwords doesn't matcch!");
  //   }

  //   resetAdmin = await prismaClient.user.update({
  //     where: { id: resetAdmin.id },
  //     data: {
  //       password: await bcrypt.hash(resetRequest.newPassword, 10),
  //       recoveryToken: null,
  //     },
  //   });
  //   return toAdminResponse(resetAdmin);
  // }

  static async update(
    user: User,
    request: AdminUpdateRequest
  ): Promise<AdminResponse> {
    const updateRequest = Validation.validate(AdminValidation.UPDATE, request);

    const admin = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!admin) {
      throw new ResponseError(404, "Admin not found");
    }

    const fieldsToUpdate: { [key: string]: any } = {
      email: updateRequest.email,
      username: updateRequest.username,
      password: updateRequest.password
        ? await bcrypt.hash(updateRequest.password, 10)
        : admin.password, // === undifined
      name: updateRequest.name,
      gender: updateRequest.gender, // enum
      birthday: updateRequest.birthday,
      telephone: updateRequest.telephone,
      userProfile: updateRequest.userProfile,
    };
    const updatedData: Partial<User> = Object.fromEntries(
      Object.entries(fieldsToUpdate).filter(([_, value]) => value !== undefined)
    );
    if (Object.keys(updatedData).length === 0) {
      throw new ResponseError(400, "No valid fields to update");
    }

    const response = await prismaClient.user.update({
      where: { id: admin.id },
      data: updatedData,
      include: { admin: true },
    });
    return toAdminResponse(response);
  }

  static async getAdmin(user: User): Promise<AdminResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const admin = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!admin) {
      throw new ResponseError(404, "Admin not found");
    }
    return toAdminResponse(admin);
  }

  static async getAdmins(user: User): Promise<AdminResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const admins = await prismaClient.user.findMany({
      where: { role: "ADMIN" },
    });
    if (!admins) {
      throw new ResponseError(404, "Admins not found");
    }
    return admins.map((admin) => toAdminResponse(admin));
  }

  static async getAdminDetails(user: User): Promise<AdminResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const admin = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!admin) {
      throw new ResponseError(404, "Admin not found");
    }
    return toAdminResponse(admin);
  }

  static async deleteAdmin(user: User, id: number): Promise<AdminResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const admin = await prismaClient.user.findUnique({
      where: { id: id },
    });
    if (!admin) {
      throw new ResponseError(404, "Admin not found");
    }
    const deletedAdmin = await prismaClient.user.delete({
      where: { id: id },
    });
    return toAdminResponse(deletedAdmin);
  }

  static async firstRegister(
    request: AdminRegisterRequest
  ): Promise<AdminResponse> {
    const checkAdmin = await prismaClient.user.findFirst({
      where: { role: "ADMIN" },
    });
    if (checkAdmin) {
      throw new ResponseError(400, "Admin already registered");
    }

    const registerRequest = Validation.validate(
      AdminValidation.REGISTER,
      request
    ); // validation
    registerRequest.password = await bcrypt.hash(registerRequest.password, 10); // hash password

    const admin = await prismaClient.user.create({
      data: {
        email: registerRequest.email,
        username: registerRequest.username,
        password: registerRequest.password,
        role: "ADMIN",
        admin: {
          create: {},
        },
      },
    });
    return toAdminResponse(admin); // push to database
  }
}
