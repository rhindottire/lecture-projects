import { Jenis } from "@prisma/client";

export type SubscribeRequest = {
  paymentId: number;
  jenis: Jenis;
};

export type SubscribeResponse = {
  id: number;
  premium: boolean;
  jenis: string;
  startDate: Date;
  endDate: Date;
  lyricDisplay: boolean;
  createPlaylist: boolean;
  downloadLagu: boolean;
  createdAt: Date;
  updatedAt: Date;
};

export function toSubscribeResponse(
  response: SubscribeResponse
): SubscribeResponse {
  return response;
};