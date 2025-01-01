import express from "express";
import cors from "cors";
import { publicRouter } from "../routers/public-api";
import { apiRoutes } from "../routers/api";
import { errorMiddleware } from "../middleware/error-middleware";
import fs from "fs";
import path from "path";
import swaggerUi from "swagger-ui-express";
import swaggerJsDoc from "swagger-jsdoc";

const app = express();

// const swaggerOptions = {
//   definition: {
//     openapi: "3.0.0",
//     info: {
//       title: "API Documentation",
//       version: "1.0.0",
//       description: "This is a simple API documentation using Swagger and TypeScript",
//     },
//     servers: [
//       {
//         url: "http://localhost:3000",
//       },
//     ],
//   },
//   apis: ["./src/api/*.ts"],
// };
// const swaggerDocs = swaggerJsDoc(swaggerOptions);
// app.use("/api", swaggerUi.serve, swaggerUi.setup(swaggerDocs));

app.use(
  cors({
    origin: ['http://localhost', 'http://localhost:8000', 'http://abogoboga.test:8000'], // Origin yang diizinkan
    methods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], // Metode yang diizinkan
  })
);
app.use(express.json());
app.use(publicRouter);
app.use(apiRoutes);
app.use(errorMiddleware);

// app.get("/", (req, res) => {
//   res.send("Hello World!");
// });
// app.get("/", (req, res) => {
//   res.json({
//     message: "Hello World!"
//   })
// });
// app.get("/:id", (req, res) => {
//   const {id} = req.params;
//   res.send(`MUSIC ${id}`);
// })

const port = 3000;
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
})

app.get("/", (req, res) => {
  const filePath = path.join(__dirname, '../template/index.html');
  fs.readFile(filePath, 'utf8', (err, data) => {
    if (err) {
      res.writeHead(500, { 'Content-Type': 'text/plain' });
      res.end('Internal Server Error');
      console.error(err);
      return;
    }
    res.writeHead(200, { 'Content-Type': 'text/html' });
    res.end(data);
  });
})