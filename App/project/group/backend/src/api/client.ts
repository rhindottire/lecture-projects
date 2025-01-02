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
 * /client:
 *   post:
 *     summary: Create a new user
 *     responses:
 *       201:
 *         description: New client created
 * /api/login/client:
 *   post:
 *     summary: Login client
 *     responses:
 *       200:
 *         description: Login client
 * /api/recoveryClient:
 *   post:
 *     summary: Recovery client
 *     responses:
 *       200:
 *         description: Recovery client
 */
router.get("/", (req, res) => {
  res.json([
    { id: 1, name: "John Doe" },
    { id: 2, name: "Jane Doe" },
  ]);
});

export default router;