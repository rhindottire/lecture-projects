import { Router } from "express";

const router = Router();

/**
 * @swagger
 * /users:
 *   get:
 *     summary: Retrieve a list of users
 *     responses:
 *       200:
 *         description: A list of users
 * /api/admin/register:
 *   post:
 *     summary: Sign up Admin
 *     responses:
 *       201:
 *         description: New admin created
 * /api/admin/login:
 *  post:
 *    summary: Sign in Admin
 *    response:
 *      200:
 *        description: Admin login successfully
 * /api/admin/recovery:
 *  post:
 *    summary: Recovery admin
 *    response:
 *      200:
 *        description: Admin recover successfully
 * /api/admin/logout:
 *  patch:
 *    summary: Logout Admin
 *    response:
 *      201:
 *        description: Admin logout successfully
 * /api/admin/reset:
 *  patch:
 *    summary: Reset Admin
 *    response:
 *      201:
 *        description: 
 * /api/admin/update:
 *  patch:
 *    summary: Update Admin
 *    response:
 *      201:
 * 
 */
router.get("/", (req, res) => {
  res.json([
    { id: 1, name: "John Doe" },
    { id: 2, name: "Jane Doe" },
  ]);
});

export default router;