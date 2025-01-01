import { Admin, Client, User } from "@prisma/client"
import { Request } from "express"

export interface UserRequest extends Request {
  id?: number
  user?: User
  admin?: Admin
  client?: Client
};