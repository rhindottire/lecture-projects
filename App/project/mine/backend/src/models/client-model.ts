export type ClientRegisterRequest = {
  email: string;
  username: string;
  password: string;
};

// export type ClientLoginRequest = {
//   E_Name: string;
//   password: string;
// };

export type ClientUpdateRequest = {
  email?: string;
  username?: string;
  password?: string;
  name?: string;
  gender?: string;
  birthday?: Date;
  telephone?: string;
  userProfile?: string;
};

// export type ClientRecoveryRequest = {
//   email: string;
//   username: string;
// };

export type ClientResponse = {
  id : number;
  email: string;
  username : string;
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

export function toClientResponse(
  response: ClientResponse
): ClientResponse {
  return response;
};