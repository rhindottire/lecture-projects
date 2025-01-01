import { Status } from "@prisma/client";

export type PaymentRequest = {
  clientId: number
  nominal: number;
  status?: Status;
};

// export enum Status {
//   FAILED = "FAILED",
//   PENDING = "PENDING",
//   SUCCESS = "SUCCESS",
// }

export type PaymentResponse = {
  id?: number;
  nominal?: number;
  status?: Status;
  createAt: Date;
  updateAt: Date;
};

export function toPaymentResponse(
  res: PaymentResponse
): PaymentResponse {
  return res
}
