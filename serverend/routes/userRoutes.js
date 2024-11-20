import express from "express";
// import { getAllUsers, createUser, updateUser, deleteUser, getUserById } from "../controllers/userController.js"; // Ensure the correct path

import UserController from '../controllers/userController.js';

const router = express.Router();

// Define your routes
// router.route("/").get(getAllUsers);
// router.route("/:id").get(getUserById);
// router.route("/").post(createUser);
// router.route("/:id").put(updateUser);
// router.route("/:id").delete(deleteUser);

router.get('/', UserController.getAllUsers);
router.post('/', UserController.createUser);
router.put('/:id', UserController.updateUser);
router.delete('/:id', UserController.deleteUser);
router.get('/:id', UserController.getUserById);

export default router; // Export the router directly
