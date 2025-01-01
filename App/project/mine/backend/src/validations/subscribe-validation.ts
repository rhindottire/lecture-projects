import { z, ZodType } from "zod";

export class SubscribeValidation {
  static readonly CREATE: ZodType = z.object({
    paymentId: z.number(),
    jenis: z.enum(["BASIC", "EXPERT", "MASTER"]),
  })
}