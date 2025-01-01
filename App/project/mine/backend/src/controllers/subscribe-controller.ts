import { NextFunction, Response } from "express";
import { SubscribeService } from "../services/subscribe-service";
import { UserRequest } from "../types/user-request";

export class SubscribeController {
  static async subscribe(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await SubscribeService.subscribe(req.body);
      res.json({
        status: 201,
        message: "Subscribe created successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getSubscribe(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await SubscribeService.getSubscribe(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "Subscribe fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getSubscribes(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await SubscribeService.getSubscribes(req.user!);
      res.json({
        status: 200,
        message: "Subscribes fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getSubscribeDetails(
    req: UserRequest,
    res: Response,
    next: NextFunction
  ) {
    try {
      const response = await SubscribeService.getSubscribeDetails(req.body);
      res.json({
        status: 200,
        message: "Subscribe Details fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }
}