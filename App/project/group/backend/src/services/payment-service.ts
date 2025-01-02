import { Client, User } from "@prisma/client";
import { prismaClient } from "../app/database";
import {
  PaymentRequest,
  PaymentResponse,
  toPaymentResponse,
} from "../models/payment-model";
import { ResponseError } from "../errors/response-error";

export class PaymentService {
  static async create(
    client: Client,
    request: PaymentRequest
  ): Promise<PaymentResponse> {
    const payment = await prismaClient.payment.create({
      data: {
        clientId: client.id,
        nominal: request.nominal,
        status: "PENDING",
      },
    });
    return toPaymentResponse(payment);
  }

  static async failed(
    paymentId: number
  ): Promise<PaymentResponse> {
    let failed = await prismaClient.payment.update({
      where: { id: paymentId },
      data: { status: "FAILED" },
    });
    return toPaymentResponse(failed);
  }

  static async deleted(
    paymentId: number
  ): Promise<PaymentResponse> {
    const deleted = await prismaClient.payment.delete({
      where: { id: paymentId },
    });
    return toPaymentResponse(deleted);
  }

  static async getPayment(
    user: User,
    request: {
      clientId: number;
      paymentId: number;
    }
  ): Promise<PaymentResponse> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const payment = await prismaClient.payment.findFirst({
      where: {
        AND: [
          { id: request.paymentId },
          { clientId: request.clientId }
        ],
      },
    });
    return toPaymentResponse(payment!);
  }

  static async getPayments(
    user: User
  ): Promise<PaymentResponse[]> {
    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }
    const payments = await prismaClient.payment.findMany({
      include: {
        client: {
          include: {
            user: true,
          },
        },
      },
    });
    return payments.map((payment) => toPaymentResponse(payment));
  }

  static async getPaymentDetails(
    client: Client
  ): Promise<PaymentResponse[]> {
    const payments = await prismaClient.payment.findMany({
      where: { clientId: client.id },
    });
    if (!payments) {
      throw new ResponseError(404, "Payment not found");
    }
    return payments.map((payment) => toPaymentResponse(payment));
  }
}
