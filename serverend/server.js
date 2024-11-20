import express from "express";
import dotenv from "dotenv";
import http from "http";
import cors from 'cors';
import { Server as SocketServer } from "socket.io";
import userRoutes from "./routes/userRoutes.js";
import chatRoutes from "./routes/chatRoutes.js"
import errorHandler from "./middleware/errorHandler.js"; // Import the error handler
import { initSocket } from "./controllers/chatController.js";

dotenv.config();

const app = express();
const server = http.createServer(app)

app.use(express.json());
app.use(cors({
  origin: 'http://localhost:3000',
  methods: ["GET", "POST"]
}))

// Use the router for '/users' endpoint
app.use("/users", userRoutes);

const io = new SocketServer(server, {
  cors: {
      origin: 'http://localhost:3000', // Ensure this matches your client URL
      methods: ["GET", "POST"],
      transports: ["websocket", "polling"], // Ensure this includes 'websocket'
  }
});

// Initialize the socket connection using the exported function
initSocket(io);

app.use("/chat", chatRoutes);

app.use((req, res, next) => {
    res.status(404).json({ message: "Not Found" });
});

// Use the error handler middleware
app.use(errorHandler);

const port = process.env.PORT || 5000;

// app.listen(port, () => {
//   console.log(`Server is running on port ${port}`);
// });

server.listen(port, () => {
  console.log('Server is running on http://localhost:5001');
});
