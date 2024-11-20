import db from "../config.js"; // Ensure this path is correct
import asyncHandler from "express-async-handler";

class UserController {
  // Get all users
  getAllUsers = asyncHandler(async (req, res) => {
    const q = "SELECT * FROM user";
    db.query(q, (err, data) => {
      if (err) return res.status(500).json({ error: err.message });
      return res.json(data);
    });
  });

  // Create a user
  createUser = asyncHandler(async (req, res) => {
    const q = "INSERT INTO user (name, email, phone) VALUES (?, ?, ?)";
    const values = [req.body.name, req.body.email, req.body.phone];
    db.query(q, values, (err) => {
      if (err) return res.status(500).json({ error: err.message });
      return res.status(200).json({ message: "User created successfully" });
    });
  });

  // Update a user
  updateUser = asyncHandler(async (req, res) => {
    const userId = req.params.id;
    const q = "UPDATE user SET name = ?, email = ?, phone = ? WHERE id = ?";
    const values = [req.body.name, req.body.email, req.body.phone, userId];
    db.query(q, values, (err, result) => {
      if (err) return res.status(500).json({ error: err.message });
      if (result.affectedRows === 0) return res.status(404).json({ message: "User not found" });
      return res.status(200).json({ message: "User updated successfully" });
    });
  });

  // Delete a user
  deleteUser = asyncHandler(async (req, res) => {
    const userId = req.params.id;
    const q = "DELETE FROM user WHERE id = ?";
    const values = [userId];
    db.query(q, values, (err, result) => {
      if (err) return res.status(500).json({ error: err.message });
      if (result.affectedRows === 0) return res.status(404).json({ message: "User not found" });
      return res.status(200).json({ message: "User deleted successfully" });
    });
  });

  // Get a specific user by ID
  getUserById = asyncHandler(async (req, res) => {
    const userId = req.params.id;
    const q = "SELECT * FROM user WHERE id = ?";
    const values = [userId];
    db.query(q, values, (err, result) => {
      if (err) return res.status(500).json({ error: err.message });
      if (result.length === 0) return res.status(404).json({ message: "User not found" });
      return res.status(200).json(result);
    });
  });
}

export default new UserController();


  // Get all users
// export const getAllUsers = asyncHandler(async (req, res) => {
//   const q = "SELECT * FROM user";
//   db.query(q, (err, data) => {
//     if (err) return res.status(500).json({ error: err.message });
//     return res.json(data);
//   });
// });

// // Create a user
// export const createUser = asyncHandler(async (req, res) => {
//   const q = "INSERT INTO user (name, email, phone) VALUES (?, ?, ?)";
//   const values = [req.body.name, req.body.email, req.body.phone];
//   db.query(q, values, (err) => {
//     if (err) return res.status(500).json({ error: err.message });
//     return res.status(200).json({ message: "User created successfully" });
//   });
// });

// // Update a user
// export const updateUser = asyncHandler(async (req, res) => {
//   const userId = req.params.id;
//   const q = "UPDATE user SET name = ?, email = ?, phone = ? WHERE id = ?";
//   const values = [req.body.name, req.body.email, req.body.phone, userId];
//   db.query(q, values, (err, result) => {
//     if (err) return res.status(500).json({ error: err.message });
//     if (result.affectedRows === 0) return res.status(404).json({ message: "User not found" });
//     return res.status(200).json({ message: "User updated successfully" });
//   });
// });

// // Delete a user
// export const deleteUser = asyncHandler(async (req, res) => {
//   const userId = req.params.id;
//   const q = "DELETE FROM user WHERE id = ?";
//   const values = [userId];
//   db.query(q, values, (err, result) => {
//     if (err) return res.status(500).json({ error: err.message });
//     if (result.affectedRows === 0) return res.status(404).json({ message: "User not found" });
//     return res.status(200).json({ message: "User deleted successfully" });
//   });
// });

// // Get a specific user by ID
// export const getUserById = asyncHandler(async (req, res) => {
//   const userId = req.params.id;
//   const q = "SELECT * FROM user WHERE id = ?";
//   const values = [userId];
//   db.query(q, values, (err, result) => {
//     if (err) return res.status(500).json({ error: err.message });
//     if (result.length === 0) return res.status(404).json({ message: "User not found" });
//     return res.status(200).json(result);
//   });
// });