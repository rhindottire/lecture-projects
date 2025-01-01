export type AdminRegisterRequest = {
  email: string;
  username: string;
  password: string;
};

// export type AdminLoginRequest = {
//   E_Name: string;
//   password: string;
// };

// export type AdminRecoveryRequest = {
//   email: string;
//   username: string;
// };

export type AdminUpdateRequest = {
  email?: string;
  username?: string;
  password?: string;
  name?: string;
  gender?: string;
  birthday?: Date;
  telephone?: string;
  userProfile?: string;
};

export type AdminResponse = {
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

export function toAdminResponse(
  response: AdminResponse
): AdminResponse {
  return response;
};