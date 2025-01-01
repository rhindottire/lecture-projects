import { NextFunction, Request, Response } from "express";
import { AdminService } from "../services/admin-service";
import { UserRequest } from "../types/user-request";

export class AdminController {
  static async register(
    req: Request,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.register(req.body);
      res.json({
        status: 201,
        message: "Admin registered successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  // static async login(
  //   req: Request,
  //   res: Response,
  //   next: NextFunction) {

  //   try {
  //     const response = await AdminService.login(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Admin logged in successfully",
  //       data: response
  //     })
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  static async logout(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.logout(req.user!);
      res.json({
        status: 201,
        message: "Admin logged out successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  // static async recoveryPassword(
  //   req: Request,
  //   res: Response,
  //   next: NextFunction) {

  //   try {
  //     const response = await AdminService.recoveryPassword(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Admin recovery password successfully",
  //       data: response
  //     })
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  // static async resetPassword(
  //   req: Request,
  //   res: Response,
  //   next: NextFunction) {

  //   try {
  //     const response = await AdminService.resetPassword(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Admin reset password successfully",
  //       data: response
  //     })
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  static async update(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.update(req.user!, req.body);
      res.json({
        status: 200,
        message: "Admin updated successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async deleteAdmin(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.deleteAdmin(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "Admin deleted successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static getAdmin(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = AdminService.getAdmin(
        req.user!
      );
      res.json({
        status: 200,
        message: "Admin fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async getAdmins(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.getAdmins(req.user!);
      res.json({
        status: 200,
        message: "Admins fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async getAdminDetails(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.getAdminDetails(req.user!);
      res.json({
        status: 200,
        message: "Admin details fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async firstRegister(
    req: Request,
    res: Response,
    next: NextFunction) {

    try {
      const response = await AdminService.firstRegister(req.body);
      res.json({
        status: 201,
        message: "Admin registered successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }
};