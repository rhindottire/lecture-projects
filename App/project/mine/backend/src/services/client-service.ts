import { User } from "@prisma/client";
import { prismaClient } from "../app/database";
import {
  ClientRegisterRequest,
  // ClientLoginRequest,
  // ClientRecoveryRequest,
  ClientUpdateRequest,
  ClientResponse,
  toClientResponse,
} from "../models/client-model";
import { ClientValidation } from "../validations/client-validation";
import { Validation } from "../validations/validation";
import bcrypt from "bcrypt";
import { v4 as uuid } from "uuid";
import { ResponseError } from "../errors/response-error";

export class ClientService {  
  static async register(
    request: ClientRegisterRequest
  ): Promise<ClientResponse> {

    const registerRequest = Validation.validate(
      ClientValidation.REGISTER,
      request
    ); // validation

    const existingClient = await prismaClient.user.findFirst({
      where: {
        OR: [
          { email: registerRequest.email },
          { username: registerRequest.username },
        ],
      },
    }); // check if email or username already exists
    if (existingClient) {
      throw new ResponseError(
        400,
        existingClient.email === registerRequest.email
          ? "Email already exists"
          : "Username already exists"
      );
    }

    registerRequest.password = await bcrypt.hash(
      registerRequest.password, 10
    ); // hash password

    const Client = await prismaClient.user.create({
      data: {
        email: registerRequest.email,
        username: registerRequest.username,
        password: registerRequest.password,
        role: "CLIENT",
        client: {
          create: {},
        },
      },
    });
    return toClientResponse(Client); // push to database
  }

  // static async login(
  //   request: ClientLoginRequest
  // ): Promise<ClientResponse> {

  //   const loginRequest = Validation.validate(
  //     ClientValidation.LOGIN,
  //     request
  //   );

  //   let loginClient = await prismaClient.user.findFirst({
  //     where: {
  //       OR: [
  //         { email: loginRequest.E_Name },
  //         { username: loginRequest.E_Name }
  //       ],
  //     },
  //   });

  //   const errorMessage = "Email or Username or Password is Incorrect!";
  //   if (!loginClient) {
  //     throw new ResponseError( 400, errorMessage ); // not found
  //   }
  //   if (loginClient.email !== loginRequest.E_Name &&
  //       loginClient.username !== loginRequest.E_Name
  //   ) {
  //     throw new ResponseError( 400, errorMessage ); // check sensitive
  //   }

  //   const isValidPassword = await bcrypt.compare(
  //     loginRequest.password,
  //     loginClient.password
  //   );
  //   if (!isValidPassword) {
  //     throw new ResponseError( 400, errorMessage );
  //   }

  //   loginClient = await prismaClient.user.update({
  //     where: { id: loginClient.id },
  //     data: { token: uuid() },
  //   });
  //   return toClientResponse(loginClient);
  // }

  static async logout(
    user: User
  ): Promise<ClientResponse> {

    let client = await prismaClient.user.findUnique({
      where: { id: user.id, },
    });
    if (!client) {
      throw new ResponseError(404, "Client not found");
    }

    client = await prismaClient.user.update({
      where: { id: client.id, },
      data: { token: null, },
    });
    return toClientResponse(client);
  }

  // static async recoveryPassword(
  //   request: ClientRecoveryRequest
  // ): Promise<ClientResponse> {

  //   const recoveryRequest = Validation.validate(
  //     ClientValidation.RECOVERY,
  //     request
  //   );

  //   let recoveryClient = await prismaClient.user.findFirst({
  //     where: {
  //       email: recoveryRequest.email,
  //       username: recoveryRequest.username
  //      },
  //   });

  //   const errorMessage = "Email or Username is Incorrect!";
  //   if (!recoveryClient) {
  //     throw new ResponseError(400, errorMessage);
  //   }
  //   if (recoveryClient.email !== recoveryRequest.email &&
  //       recoveryClient.username !== recoveryRequest.username
  //   ) {
  //     throw new ResponseError(400, errorMessage);
  //   }

  //   recoveryClient = await prismaClient.user.update({
  //     where: { id: recoveryClient.id },
  //     data: { recoveryToken: uuid() },
  //   });
  //   return toClientResponse(recoveryClient);
  // }

  // static async resetPassword(
  //   request: {
  //     password: string;
  //     newPassword: string;
  //     recoveryToken: string;
  //   }
  // ): Promise<ClientResponse> {

  //   const resetRequest = Validation.validate(
  //     ClientValidation.RESET,
  //     request
  //   );

  //   let resetClient = await prismaClient.user.findFirst({
  //     where: { recoveryToken: resetRequest.recoveryToken },
  //   });
  //   if (!resetClient) {
  //     throw new ResponseError(400, "Recovery Token is Incorrect!");
  //   }
  //   if (resetRequest.password !== resetRequest.newPassword) {
  //     throw new ResponseError(400, "Passwords doesn't matcch!");
  //   }

  //   resetClient = await prismaClient.user.update({
  //     where: { id: resetClient.id },
  //     data: {
  //       password: await bcrypt.hash(resetRequest.newPassword, 10),
  //       recoveryToken: null,
  //     },
  //   });
  //   return toClientResponse(resetClient);
  // }

  static async update(
    user: User,
    request: ClientUpdateRequest
  ): Promise<ClientResponse> {

    const updateRequest = Validation.validate(
      ClientValidation.UPDATE,
      request
    );

    const client = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!client) {
      throw new ResponseError(404, "Client not found");
    }

    const fieldsToUpdate: { [key: string]: any } = {
      email: updateRequest.email,
      username: updateRequest.username,
      password: updateRequest.password
        ? await bcrypt.hash(updateRequest.password, 10)
        : client.password, // === undifined
      name: updateRequest.name,
      gender: updateRequest.gender, // enum
      birthday: updateRequest.birthday
        ? new Date(updateRequest.birthday)
        : undefined,
      telephone: updateRequest.telephone,
      userProfile: updateRequest.userProfile
    };
    const updatedData: Partial<User> = Object.fromEntries(
      Object.entries(fieldsToUpdate).filter(
        ([_, value]) => value !== undefined
      )
    );
    if (Object.keys(updatedData).length === 0) {
      throw new ResponseError(400, "No valid fields to update");
    }
    const response = await prismaClient.user.update({
      where: { id: client.id },
      data: updatedData,
      include: { client: true },
    });
    return toClientResponse(response);
  }

  static async getClient(
    user: User,
    id: number
  ): Promise<ClientResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const client = await prismaClient.user.findUnique({
      where: { id: id },
    });
    if (!client) {
      throw new ResponseError(404, "Client not found");
    }
    return toClientResponse(client);
  }

  static async getClients(
    user: User
  ): Promise<ClientResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const clients = await prismaClient.user.findMany({
      where: { role: "CLIENT" },
    });
    if (!clients) {
      throw new ResponseError(404, "Clients not found");
    }
    return clients.map((client) => toClientResponse(client));
  }

  static async getClientDetails(
    user: User
  ): Promise<ClientResponse> {
    if (user.role !== "CLIENT") {
      throw new ResponseError(401, "Unauthorized");
    }
    const client = await prismaClient.user.findUnique({
      where: { id: user.id },
    });
    if (!client) {
      throw new ResponseError(404, "Client not found");
    }
    return toClientResponse(client);
  }

  static async deleteClient(
    user: User,
    id: number
  ): Promise<ClientResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const admin = await prismaClient.user.findUnique({
      where: { id: id },
    });
    if (!admin) {
      throw new ResponseError(404, "Client not found");
    }
    const deletedClient = await prismaClient.user.delete({
      where: { id: id },
    });
    return toClientResponse(deletedClient);
  }
}