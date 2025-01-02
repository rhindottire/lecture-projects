import { NextFunction, Request, Response } from "express";
import { PaymentService } from "../services/payment-service";
import { UserRequest } from "../types/user-request";

export class PaymentController {
  static async create(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await PaymentService.create(req.client!, req.body);
      res.json({
        status: 201,
        message: "Success create payment",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async failed(
    req: Request,
    res: Response,
    next: NextFunction
  ) {
    try {
      const respone = await PaymentService.failed(req.body);
      res.json({
        status: 201,
        message: "Payment failed status saved successfully",
        data: respone
      });
    } catch (error) {
      next(error);
    }
  }

  static async deleted(
    req: Request,
    res: Response,
    next:NextFunction,
  ) {
    try {
      const respone = await PaymentService.deleted(
        Number(req.params.paymentId)
      );
      res.json({
        status : 201,
        messgae: "Payment got deleted",
        data: respone
      });
    } catch (error) {
      next(error);
    }
  }

  static async getPayment(
    req: UserRequest,
    res: Response,
    next: NextFunction,
  ) {
    try {
      const respone = await PaymentService.getPayment(
        req.user!,
        req.body
      );
      res.json({
        status: 200,
        message: "Payment fetched successfullt",
        data: respone
      })
    } catch (error) {
      next(error);
    }
  }

  static async getPayments(
    req: UserRequest,
    res: Response,
    next: NextFunction,
  ) {
    try {
      const respone = await PaymentService.getPayments(
        req.user!
      );
      res.json({
        status: 200,
        message: "Payments fetched successfully",
        data: respone
      });
    } catch (error) {
      next(error);
    }
  }

  static async getPaymentDetails(
    req: UserRequest,
    res: Response,
    next: NextFunction,
  ) {
    try {
      const respone = await PaymentService.getPaymentDetails(req.client!);
    } catch (error) {
      next(error);
    }
  }
}