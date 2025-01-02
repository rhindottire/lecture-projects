export type UserLoginRequest = {
  E_Name: string;
  password: string;
};

export type UserUpdateRequest = {
  name?: string;
  gender?: string;
  birthday?: Date;
  telephone?: string;
  userProfile?: string;
};

export type UserRecoveryRequest = {
  email: string;
  username: string;
};

export type UserResetRequest = {
  password: string;
  newPassword: string;
  recoveryToken: string;
};

export type UserResponse = {
  id: number;
  email: string;
  username: string;
  password: string;
  role: string;
  name?: string | null;
  gender?: string | null;
  birthday?: Date | null;
  userProfile?: string | null;
  token?: string | null;
  recoveryToken?: string | null;
  createAt: Date;
  updateAt: Date;
};

export function toUserResponse(
  response: UserResponse
): UserResponse {
  return response;
};