import { NextFunction, Request, Response } from "express";
import { UserService } from "../services/user-service";
import { UserRequest } from "../types/user-request";

export class UserController {
  static async createServer(req: Request, res: Response, next: NextFunction) {
    try {
      const response = await UserService.createServer();
      res.json({
        status: 201,
        message: "Server created successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async serverOnline(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.serverOnline(req.user!);
      res.json({
        status: 201,
        message: "Server is Online",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async serverOffline(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.serverOffline(req.user!);
      res.json({
        status: 201,
        message: "Server Maintenance successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async login(req: Request, res: Response, next: NextFunction) {
    try {
      const response = await UserService.login(req.body);
      res.json({
        status: 200,
        message: "User logged in successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  // static async logout(req: UserRequest, res: Response, next: NextFunction,) {
  //   try {
  //     const response = await UserService.logout(req.user!);
  //     res.json({
  //       status: 201,
  //       message: "User Logout Successfully",
  //       data : response
  //     });
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  static async userFirstLogin(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.userFirstLogin(req.user!, req.body);
      res.json({
        status: 201,
        message: "User updated successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async recoveryPassword(req: Request, res: Response, next: NextFunction) {
    try {
      const response = await UserService.recoveryPassword(req.body);
      res.json({
        status: 201,
        message: "Recovery password sent successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async resetPassword(req: Request, res: Response, next: NextFunction) {
    try {
      const response = await UserService.resetPassword(req.body);
      res.json({
        status: 201,
        message: "Recovery password sent successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getUser(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.getUser(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "User fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getUsers(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.getUsers(req.user!);
      res.json({
        status: 200,
        message: "Users fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getUserDetails(req: UserRequest, res: Response, next: NextFunction) {
    try {
      const response = await UserService.getUserDetails(req.user!);
      res.json({
        status: 200,
        message: "User detail fetched succesfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }
}
