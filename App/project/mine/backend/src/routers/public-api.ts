import express from "express";
import { ClientController } from "../controllers/client-controller";
import { AdminController } from "../controllers/admin-controller";
import { UserController } from "../controllers/user-controller";

export const publicRouter = express.Router();

publicRouter.post("/api/createServer", UserController.createServer);
publicRouter.post("/api/adminFirstRegister", AdminController.firstRegister); // ✅
publicRouter.post("/api/client/register", ClientController.register);        // ✅

publicRouter.post("/api/user/login", UserController.login);                  // ✅
// publicRouter.post("/api/admin/login", AdminController.login);
// publicRouter.post("/api/client/login", ClientController.login);

publicRouter.post("/api/user/recovery", UserController.recoveryPassword);     // ✅
// publicRouter.post("/api/admin/recovery", AdminController.recoveryPassword);
// publicRouter.post("/api/client/recovery", ClientController.recoveryPassword);

publicRouter.post("/api/user/reset", UserController.resetPassword);           // ✅