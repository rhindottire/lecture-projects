import { NextFunction, Request, Response } from "express";
import { ClientService } from "../services/client-service";
import { UserRequest } from "../types/user-request";

export class ClientController {
  static async register(
    req: Request,
    res: Response,
    next: NextFunction) {

    try {
      const response = await ClientService.register(req.body);
      res.json({
        status: 201,
        message: "Client registered successfully",
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
  //     const response = await ClientService.login(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Client logged in successfully",
  //       data: response
  //     })
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  static async logout(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.logout(req.user!);
      res.json({
        status: 201,
        message: "Client logged out successfully",
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
  //     const response = await ClientService.recoveryPassword(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Client recovery password successfully",
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
  //     const response = await ClientService.resetPassword(req.body);
  //     res.json({
  //       status: 200,
  //       message: "Client reset password successfully",
  //       data: response
  //     })
  //   } catch (error) {
  //     next(error);
  //   }
  // }

  static async update(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.update(req.user!, req.body);
      res.json({
        status: 201,
        message: "Client updated successfully",
        data: response
      });
    } catch (error) {
      next(error);
    }
  }

  static async deleteClient(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.deleteClient(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "Client deleted successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async getClient(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.getClient(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "Client fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async getClients(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.getClients(req.user!);
      res.json({
        status: 200,
        message: "CLients fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }

  static async getClientDetails(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await ClientService.getClientDetails(req.user!);
      res.json({
        status: 200,
        message: "Client details fetched successfully",
        data: response
      })
    } catch (error) {
      next(error);
    }
  }
};