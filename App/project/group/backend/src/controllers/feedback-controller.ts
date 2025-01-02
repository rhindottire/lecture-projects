import { NextFunction, Response } from "express";
import { UserRequest } from "../types/user-request";
import { FeedbackService } from "../services/feedback-service";

export class FeedbackController {
  static async createFeedback(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.createFeedback(
        req.user!,
        req.client!,
        req.body
      );
      res.json({
        status: 201,
        message: "Feedback created successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async updateFeedback(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.updateFeedback(
        Number(req.params.id),
        req.user!,
        req.client!,
        req.body
      );
      res.json({
        status: 201,
        message: "Feedback updated successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async deleteFeedback(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.deleteFeedback(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 201,
        message: "Feedback deleted successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getFeedback(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.getFeedback(
        req.user!,
        Number(req.params.id)
      );
      res.json({
        status: 200,
        message: "Feedback fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getFeedbacks(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.getFeedbacks(req.user!);
      res.json({
        status: 200,
        message: "Feedbacks fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async getClientFeedbacks(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.getClientFeedbacks(
        req.user!,
        req.client!
      );
      res.json({
        status: 200,
        message: "Client Feedbacks fetched successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }

  static async adminReply(
    req: UserRequest,
    res: Response,
    next: NextFunction) {

    try {
      const response = await FeedbackService.adminReply(
        req.user!,
        req.admin!,
        Number(req.params.id),
        req.body
      );
      res.json({
        status: 201,
        message: "Feedback updated successfully",
        data: response,
      });
    } catch (error) {
      next(error);
    }
  }
};