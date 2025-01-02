import { Admin, Client, User } from "@prisma/client";
import {
  FeedbackRequest,
  FeedbackResponse,
  FeedbackUpdateRequest,
  toFeedbackRespone,
} from "../models/feedback-model";
import { ResponseError } from "../errors/response-error";
import { prismaClient } from "../app/database";
import { Validation } from "../validations/validation";
import { FeedbackValidation } from "../validations/feedback-validation";

export class FeedbackService {
  static async createFeedback(
    user: User,
    client: Client,
    request: FeedbackRequest
  ): Promise<FeedbackResponse> {

    if (user.role !== "CLIENT") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedbackRequest = Validation.validate(
      FeedbackValidation.CREATE,
      request
    );

    const oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    const existingFeedback = await prismaClient.feedback.findFirst({
      where: {
        clientId: client.id,
        createAt: {
          gte: oneWeekAgo, // Feedback yang dibuat >= 1 minggu yang lalu
        },
      },
    });
    if (existingFeedback) {
      const nextAvailableDate = new Date(existingFeedback.createAt);
      nextAvailableDate.setDate(nextAvailableDate.getDate() + 7);
      throw new ResponseError(
        409,
        `You can only submit feedback once every 7 days.\n
        Try again after ${nextAvailableDate.toISOString()}.`
      );
    }

    const createFeedback = await prismaClient.feedback.create({
      data: {
        clientId: client.id,
        criticism: feedbackRequest.criticism,
        suggestion: feedbackRequest.suggestion
          ? feedbackRequest.suggestion
          : null,
        rating: feedbackRequest.rating
          ? feedbackRequest.rating
          : null,
      },
    });
    return toFeedbackRespone(createFeedback);
  }

  static async updateFeedback(
    id: number,
    user: User,
    client: Client,
    request: FeedbackUpdateRequest
  ): Promise<FeedbackResponse> {

    if (user.role !== "CLIENT") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedbackRequest = Validation.validate(
      FeedbackValidation.UPDATE,
      request
    );

    const feedback = await prismaClient.feedback.findFirst({
      where: {
        id: id,
        clientId: client.id
      },
    });
    if (!feedback) {
      throw new ResponseError(
        404,
        "Feedback not found"
      );
    }
    if (feedback.clientId !== client.id) {
      throw new ResponseError(
        403,
        "You do not have permission to update this feedback"
      );
    }

    const oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    const existingFeedback = await prismaClient.feedback.findFirst({
      where: {
        clientId: client.id,
        updateAt: {
          gte: oneWeekAgo, // Feedback yang dibuat >= 1 minggu yang lalu
        },
      },
    });

    if (feedback.createAt.toISOString() !=
        feedback.updateAt.toISOString() &&
        existingFeedback
      ) {
      const nextAvailableDate = new Date(existingFeedback.updateAt);
      nextAvailableDate.setDate(nextAvailableDate.getDate() + 7);
      throw new ResponseError(
        409,
        `You can only update feedback once every 7 days.\n
        Try again after ${nextAvailableDate.toISOString()}.`
      );
    }

    const updatedFeedback = await prismaClient.feedback.update({
      where: {
        id: Number(request.id),
        clientId: client.id
      },
      data: {
        criticism: feedbackRequest.criticism,
        suggestion: feedbackRequest.suggestion
          ? feedbackRequest.suggestion
          : null,
        rating: feedbackRequest.rating
          ? feedbackRequest.rating
          : null,
      },
    });
    return toFeedbackRespone(updatedFeedback);
  }

  static async deleteFeedback(
    user: User,
    id: number
  ): Promise<FeedbackResponse> {

    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedback = await prismaClient.feedback.findUnique({
      where: { id: id },
    });
    if (!feedback) {
      throw new ResponseError(404, "Feedback not found");
    }

    const deletedFeedback = await prismaClient.feedback.delete({
      where: { id: id },
    });
    return toFeedbackRespone(deletedFeedback);
  }

  static async getFeedback(
    user: User,
    id: number
  ): Promise<FeedbackResponse> {

    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedback = await prismaClient.feedback.findUnique({
      where: { id: id },
      include: {
        client: {
          include: { user: true },
        },
      },
    });
    if (!feedback) {
      throw new ResponseError(404, "Feedback not found");
    }

    return toFeedbackRespone(feedback);
  }

  static async getFeedbacks(
    user: User
  ): Promise<FeedbackResponse[]> {

    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedbacks = await prismaClient.feedback.findMany({
      include: {
        admin: {
          include: {
            user: true
          },
        },
        client: {
          include: {
            user: true
          },
        }
      }
    });
    return feedbacks.map((feedback) => toFeedbackRespone(feedback));
  }

  static async getClientFeedbacks(
    user: User,
    client: Client
  ): Promise<FeedbackResponse[]> {

    if (user.role !== "CLIENT") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedbacks = await prismaClient.feedback.findMany({
      where: {
        clientId: client.id
      },
      include: {
        admin: {
          include: {
            user: true
          },
        },
        client: {
          include: {
            user: true
          },
        }
      }
    });
    return feedbacks.map((feedback) => {
      return toFeedbackRespone(feedback);
    })
  }

  static async adminReply(
    user: User,
    admin: Admin,
    id: number,
    request: {
      adminReply: string
    }
  ): Promise<FeedbackResponse> {

    const replyRequest = Validation.validate(
      FeedbackValidation.ADMIN_REPLY,
      request
    );

    if (user.role !== "ADMIN") {
      throw new ResponseError(401, "Unauthorized");
    }

    const feedback = await prismaClient.feedback.findUnique({
      where: { id: id },
    });

    if (!feedback) {
      throw new ResponseError(
        404,
        "Feedback not found"
      );
    }
    if (feedback.adminId && feedback.adminId !== admin.id) {
      throw new ResponseError(
        403,
        "You do not have permission to reply this feedback"
      );
    }

    const createFeedback = await prismaClient.feedback.update({
      where: { id: id },
      data: {
        adminId: admin.id,
        adminReply: replyRequest.adminReply,
      },
    })
    return toFeedbackRespone(createFeedback);
  }
};