export type FeedbackRequest = {
  id?: number;
  clientId: number;
  criticism: string;
  suggestion?: string;
  rating?: number;
};

export type FeedbackUpdateRequest = {
  id: number;
  criticism?: string;
  suggestion?: string;
  rating?: number;
};

export type FeedbackResponse = {
  id: number;
  clientId: number;
  adminId?: number | null;
  criticism: string;
  suggestion?: string | null;
  rating?: number | null;
  adminReply?: string | null;
  createAt: Date;
  updateAt: Date;
};

export function toFeedbackRespone(
  response: FeedbackResponse 
): FeedbackResponse {
  return response;
};