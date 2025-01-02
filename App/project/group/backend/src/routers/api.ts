import express from "express";
import { authMiddleware } from "../middleware/auth-middleware";
import { ClientController } from "../controllers/client-controller";
import { AdminController } from "../controllers/admin-controller";
import { FeedbackController } from "../controllers/feedback-controller";
import { SubscribeController } from "../controllers/subscribe-controller";
import { UserController } from "../controllers/user-controller";
import { PaymentController } from "../controllers/payment-controller";

export const apiRoutes = express.Router();
apiRoutes.use(authMiddleware);

apiRoutes.patch("/api/serverOnline", UserController.serverOnline);
apiRoutes.patch("/api/serverOffline", UserController.serverOffline);

apiRoutes.post("/api/userFirstLogin", UserController.userFirstLogin); // ✅

apiRoutes.post("/api/register/admin", AdminController.register);

// apiRoutes.patch("/api/user/logout", UserController.logout);
apiRoutes.patch("/api/admin/logout", AdminController.logout); // ✅
apiRoutes.patch("/api/client/logout", ClientController.logout); // ✅

apiRoutes.patch("/api/user/reset", UserController.resetPassword);
// apiRoutes.patch("/api/admin/reset", AdminController.resetPassword);
// apiRoutes.patch("/api/client/reset", ClientController.resetPassword);

apiRoutes.patch("/api/admin/update", AdminController.update);
apiRoutes.patch("/api/client/update", ClientController.update);

apiRoutes.delete("/api/admin/delete/:id", AdminController.deleteAdmin);
apiRoutes.delete("/api/client/delete/:id", ClientController.deleteClient);

apiRoutes.get("/api/getUsers", UserController.getUsers); // ✅
apiRoutes.get("/api/getUser/:id", UserController.getUser); // ✅
apiRoutes.get("/api/getUserDetails", UserController.getUserDetails); // ✅

apiRoutes.get("/api/getAdmins", AdminController.getAdmins); // ✅
apiRoutes.get("/api/getAdmin/:id", AdminController.getAdmin); // ✅
apiRoutes.get("/api/getAdminDetails", AdminController.getAdminDetails); // ✅

apiRoutes.get("/api/getClients", ClientController.getClients); // ✅
apiRoutes.get("/api/getClient/:id", ClientController.getClient); // ✅
apiRoutes.get("/api/getClientDetails", ClientController.getClientDetails); // ✅

apiRoutes.get("/api/getFeedbacks", FeedbackController.getFeedbacks);
apiRoutes.get("/api/getFeedback/:id", FeedbackController.getFeedback); // ✅
apiRoutes.get("/api/getClientFeedbacks", FeedbackController.getClientFeedbacks);
apiRoutes.post("/api/createFeedback", FeedbackController.createFeedback); // ✅
apiRoutes.patch("/api/updateFeedback/:id", FeedbackController.updateFeedback);
apiRoutes.delete("/api/deleteFeedback/:id", FeedbackController.deleteFeedback);
apiRoutes.patch("/api/adminReply/:id", FeedbackController.adminReply); // ✅

apiRoutes.post("/api/payment", PaymentController.create);
apiRoutes.get("/api/getPayments", PaymentController.getPayments);
apiRoutes.get("/api/getPayment/:id", PaymentController.getPayment);
apiRoutes.get("/api/getPaymentDetails", PaymentController.getPaymentDetails);
apiRoutes.patch("/api/paymentFailed/:paymentId", PaymentController.failed);
apiRoutes.delete("/api/paymentDeleted/:paymentId", PaymentController.deleted);
 
apiRoutes.post("/api/subscribe", SubscribeController.subscribe);
apiRoutes.get("/api/getSubscribes", SubscribeController.getSubscribes);
apiRoutes.get("/api/getSubscribe/:id", SubscribeController.getSubscribe);
apiRoutes.get("/api/getSubscribeDetails", SubscribeController.getSubscribeDetails);