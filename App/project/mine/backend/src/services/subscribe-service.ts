import { Client, Subscribe, User } from "@prisma/client";
import {
  SubscribeRequest,
  SubscribeResponse,
  toSubscribeResponse,
} from "../models/subscribe-model";
import { SubscribeValidation } from "../validations/subscribe-validation";
import { Validation } from "../validations/validation";
import { prismaClient } from "../app/database";
import { ResponseError } from "../errors/response-error";

export class SubscribeService {
  static async subscribe(
    request: SubscribeRequest
  ): Promise<SubscribeResponse> {

    const subscribeRequest = Validation.validate(
      SubscribeValidation.CREATE,
      request
    );

    let startDate: any;
    let endDate: any;
    let lyricDisplay: boolean = false;
    let createPlaylist: boolean = false;
    let downloadLagu: boolean = false;

    if (subscribeRequest.jenis === "BASIC") {
      startDate = new Date();
      endDate = new Date(startDate.getDate() + 1);
      lyricDisplay = true;
    }

    if (subscribeRequest.jenis === "EXPERT") {
      startDate = new Date();
      endDate = new Date(startDate.getDate() + 7);
      lyricDisplay = true;
      createPlaylist = true;
    }

    if (subscribeRequest.jenis === "MASTER") {
      startDate = new Date();
      endDate = new Date(startDate.getDate() + 30);
      lyricDisplay = true;
      createPlaylist = true;
      downloadLagu = true;
    }

    const subscribe = await prismaClient.subscribe.create({
      data: {
        paymentId: subscribeRequest.paymentId,
        jenis: subscribeRequest.jenis,
        startDate: startDate,
        endDate: endDate,
        lyricDisplay: lyricDisplay,
        createPlaylist: createPlaylist,
        downloadLagu: downloadLagu,
        premium: true,
      },
    });
    await prismaClient.payment.update({
      where: { id: subscribe.paymentId },
      data: { status: "SUCCESS" },
    });
    return toSubscribeResponse(subscribe);
  }

  static async getSubscribe(
    user: User,
    id: number
  ): Promise<SubscribeResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const Subscribe = await prismaClient.subscribe.findUnique({
      where: { id: id },
    });
    if (!Subscribe) {
      throw new ResponseError(404, "Subscribe not found");
    }
    return toSubscribeResponse(Subscribe);
  }

  static async getSubscribes(
    user: User
  ): Promise<SubscribeResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const subscribes = await prismaClient.subscribe.findMany({
      include: {
        payment: {
          include: {
            client: {
              include: {
                user: true,
              },
            },
          },
        },
      },
    });
    return subscribes.map((subscribe) => toSubscribeResponse(subscribe));
  }

  static async getSubscribeDetails(
    client: Client
  ): Promise<SubscribeResponse[]> {
    const subscribes = await prismaClient.subscribe.findMany({
      where: {
        payment: {
          clientId: client.id
        }
      }
    });
    if (subscribes.length === 0) {
      throw new ResponseError(404, "Subscribe not found");
    }
    return subscribes.map((subscribe) => toSubscribeResponse(subscribe));
  }
}
