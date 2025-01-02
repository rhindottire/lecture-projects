import { z, ZodType } from "zod";

export class ClientValidation {
  static readonly REGISTER: ZodType = z.object({
    email: z.string().email().max(191),
    username: z.string().min(1).max(191),
    password: z.string().min(1).max(191)
  })

  // static readonly LOGIN: ZodType = z.object({
  //   E_Name: z.string(),
  //   password: z.string().min(1).max(191)
  // })

  // static readonly RECOVERY: ZodType = z.object({
  //   email: z.string().email().max(191),
  //   username: z.string().min(1).max(191)
  // })

  // static readonly RESET: ZodType = z.object({
  //   password: z.string().min(1).max(191),
  //   newPassword: z.string().min(1).max(191),
  //   recoveryToken: z.string()
  // })

  static readonly UPDATE: ZodType = z.object({
    email: z.string().email().max(191).optional(),
    username: z.string().max(191).optional(),
    password: z.string().max(191).optional(),
    name: z.string().max(191).optional(),
    gender: z.enum(["MAN", "WOMAN"]).optional(),
    birthday: z.date().optional(),
    telephone: z.string().max(13).optional(),
    userProfile: z.string().optional()
  })
}