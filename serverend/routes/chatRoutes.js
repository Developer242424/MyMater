import express, { Router } from "express"
import { open } from "../controllers/chatController.js"

const router = express.Router()

router.route('/').get(open)

export default router