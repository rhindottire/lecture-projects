import { z, ZodType } from "zod";

export class AdminValidation {
  static readonly REGISTER: ZodType = z.object({
    email: z.string().email().max(100),
    username: z.string().min(1).max(100),
    password: z.string().min(1).max(100)
  })

  // static readonly LOGIN: ZodType = z.object({
  //   E_Name: z.string(),
  //   password: z.string().min(1).max(100)
  // })

  // static readonly RECOVERY: ZodType = z.object({
  //   email: z.string().email().max(100),
  //   username: z.string().min(1).max(100)
  // })

  // static readonly RESET: ZodType = z.object({
  //   password: z.string().min(1).max(100),
  //   newPassword: z.string().min(1).max(100),
  //   recoveryToken: z.string()
  // })

  static readonly UPDATE: ZodType = z.object({
    email: z.string().email().max(100).optional(),
    username: z.string().min(1).max(100).optional(),
    password: z.string().min(1).max(100).optional(),
    name: z.string().min(1).max(100).optional(),
    gender: z.enum(["MAN", "WOMAN"]).optional(),
    birthday: z.date().optional(),
    telephone: z.string().min(11).max(13).optional(),
    userProfile: z.string().optional() // url
  })
}