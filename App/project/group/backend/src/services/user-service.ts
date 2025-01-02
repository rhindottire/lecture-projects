import { User } from "@prisma/client";
import { prismaClient } from "../app/database";
import { ResponseError } from "../errors/response-error";
import {
  toUserResponse,
  UserLoginRequest,
  UserRecoveryRequest,
  UserResetRequest,
  UserResponse,
  UserUpdateRequest,
} from "../models/user-model";
import { UserValidation } from "../validations/user-validation";
import { Validation } from "../validations/validation";
import bcrypt from "bcrypt";
import { v4 as uuid } from "uuid";

export class UserService {
  static async createServer(): Promise<string> {
    const server = await prismaClient.server.create({
      data: { status: "ONLINE" },
    });
    return server.status;
  }

  static async serverOnline(user: User): Promise<string> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    if (user.id !== 1) {
      throw new ResponseError(
        403,
        "Forbidden: Hanya bisa diaktifkan oleh ADMIN RIDHO"
      );
    }
    const server = await prismaClient.server.update({
      where: { status: "OFFLINE" },
      data: { status: "ONLINE" },
    });
    if (!server) {
      throw new ResponseError(500, "Failed to set server to ONLINE");
    }
    return "Server is now ONLINE";
  }

  static async serverOffline(user: User): Promise<UserResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    if (user.id !== 1) {
      throw new ResponseError(
        403,
        "Forbidden: Hanya bisa diaktifkan oleh ADMIN RIDHO"
      );
    }
    await prismaClient.server.update({
      where: { status: "ONLINE" },
      data: { status: "OFFLINE" },
    });
    const affectedUsers = await prismaClient.user.findMany({
      where: { role: "CLIENT" },
    });
    await prismaClient.user.updateMany({
      where: { role: "CLIENT" },
      data: { token: null },
    });
    return affectedUsers.map((user) => toUserResponse(user));
  }

  static async login(request: UserLoginRequest): Promise<UserResponse> {
    const serverStatus = await prismaClient.server.findUnique({
      where: { status: "OFFLINE" },
    });
    if (serverStatus) {
      throw new ResponseError(500, "Server is Maintenance!");
    }

    const loginRequest = Validation.validate(UserValidation.LOGIN, request);
    let loginUser = await prismaClient.user.findFirst({
      where: {
        OR: [
          { email: loginRequest.E_Name },
          { username: loginRequest.E_Name }
        ],
      },
    });

    const errorMessage = "Email or Username or Password is Incorrect!";
    if (!loginUser) {
      throw new ResponseError(400, errorMessage); // not found
    }
    if (
      loginUser.email !== loginRequest.E_Name &&
      loginUser.username !== loginRequest.E_Name
    ) {
      throw new ResponseError(400, errorMessage); // check sensitive
    }

    const isValidPassword = await bcrypt.compare(
      loginRequest.password,
      loginUser.password
    );
    if (!isValidPassword) {
      throw new ResponseError(400, "Password is Incorrect!");
    }

    loginUser = await prismaClient.user.update({
      where: { id: loginUser.id },
      data: { token: uuid() },
    });
    return toUserResponse(loginUser);
  }

  // static async logout(
  //   user: User
  // ): Promise<UserResponse> {
  //   let userLogout = await prismaClient.user.findUnique({
  //     where: { id: user.id },
  //   });
  //   if (!userLogout) {
  //     throw new ResponseError(404, "User not found");
  //   }
  //   userLogout = await prismaClient.user.update({
  //     where: { id: user.id },
  //     data: { token: null },
  //   });
  //   return toUserResponse(userLogout);
  // }

  static async userFirstLogin(
    user: User,
    request: UserUpdateRequest
  ): Promise<UserResponse> {
    const updateRequest = Validation.validate(UserValidation.UPDATE, request);

    const USER = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!USER) {
      throw new ResponseError(404, "user not found");
    }

    const fieldsToUpdate: { [key: string]: any } = {
      name: updateRequest.name,
      gender: updateRequest.gender, // enum
      birthday: updateRequest.birthday
        ? new Date(updateRequest.birthday)
        : undefined,
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
      where: { id: user.id },
      data: updatedData,
    });
    return toUserResponse(response);
  }

  static async recoveryPassword(
    request: UserRecoveryRequest
  ): Promise<UserResponse> {
    const recoveryRequest = Validation.validate(
      UserValidation.RECOVERY,
      request
    );

    let recoveryUser = await prismaClient.user.findFirst({
      where: {
        email: recoveryRequest.email,
        username: recoveryRequest.username,
      },
    });

    const errorMessage = "Email or Username is Incorrect!";
    if (!recoveryUser) {
      throw new ResponseError(400, errorMessage);
    }
    if (
      recoveryUser.email !== recoveryRequest.email &&
      recoveryUser.username !== recoveryRequest.username
    ) {
      throw new ResponseError(400, errorMessage);
    }

    recoveryUser = await prismaClient.user.update({
      where: { id: recoveryUser.id },
      data: { recoveryToken: uuid() },
    });
    return toUserResponse(recoveryUser);
  }

  static async resetPassword(request: UserResetRequest): Promise<UserResponse> {
    const resetRequest = Validation.validate(UserValidation.RESET, request);

    let resetUser = await prismaClient.user.findFirst({
      where: { recoveryToken: resetRequest.recoveryToken },
    });
    if (!resetUser) {
      throw new ResponseError(400, "Token is invalid!");
    }
    if (resetRequest.password !== resetRequest.newPassword) {
      throw new ResponseError(400, "Passwords doesn't match!");
    }

    resetUser = await prismaClient.user.update({
      where: { id: resetUser.id },
      data: {
        password: await bcrypt.hash(resetRequest.newPassword, 10),
        recoveryToken: null,
      },
    });
    return toUserResponse(resetUser);
  }

  static async getUser(user: User, id: number): Promise<UserResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const USER = await prismaClient.user.findUnique({
      where: { id: id },
    });
    if (!USER) {
      throw new ResponseError(404, "User not found");
    }
    return toUserResponse(USER);
  }

  static async getUsers(user: User): Promise<UserResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const USERS = await prismaClient.user.findMany({});
    return USERS.map((user) => toUserResponse(user));
  }

  static async getUserDetails(user: User): Promise<UserResponse> {
    const USER = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!USER) {
      throw new ResponseError(404, "User not found");
    }
    return toUserResponse(USER);
  }
}
