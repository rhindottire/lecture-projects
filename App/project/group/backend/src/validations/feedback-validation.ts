import { z, ZodType } from "zod";

export class FeedbackValidation {
  static readonly CREATE: ZodType = z.object({
    criticism: z.string().min(1).max(100),
    suggestion: z.string().optional(),
    rating: z.number().optional()
  });

  static readonly UPDATE: ZodType = z.object({
    criticism: z.string().max(100).optional(),
    suggestion: z.string().max(100).optional(),
    rating: z.number().max(10).optional()
  });

  static readonly ADMIN_REPLY: ZodType = z.object({
    adminReply: z.string().min(1).max(100)
  });

  static readonly ADMIN_UPDATE: ZodType = z.object({
    criticism: z.string().max(100).optional(),
  });
}