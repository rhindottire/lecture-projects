import { NextFunction, Response } from "express";
import { UserRequest } from "../types/user-request";
import { prismaClient } from "../app/database";

export const authMiddleware = async (
  req: UserRequest,
  res: Response,
  next: NextFunction
) => {
  const excludeRoutes = [
    "/api/adminFirstRegister",
    "/api/register/client",
    // "/api/login/admin",
    // "/api/login/client",
    // "/api/recoveryAdmin",
    // "/api/recoveryClient",
    "/api/user/login",
    "/api/user/recovery",
    "/api/user/reset",
  ];
  if (!req.path.startsWith("/api")) {
    return next();
  }
  if (excludeRoutes.includes(req.path)) {
    return next();
  }
  const token = req.get("X-API-TOKEN");
  if (token) {
    const user = await prismaClient.user.findFirst({
      where: {
        token: token,
      },
    });

    const admin = await prismaClient.admin.findFirst({
      where: {
        userId: user?.id
      },
    })

    const client = await prismaClient.client.findFirst({
      where: {
        userId: user?.id
      },
    });

    if (user && admin) {
      req.user = user;
      req.admin = admin;
      return next();
    }

    if (user && client) {
      req.user = user;
      req.client = client;
      return next();
    }
  }
  res
  .status(401)
  .json({
    status: 401,
    message: "Unauthorized",
  })
  .end();
};
