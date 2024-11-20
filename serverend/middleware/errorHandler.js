import statusCodes from "../constants.js";

const errorHandler = (err, req, res, next) => {
  const statusCode = res.statusCode ? res.statusCode : 500;

  switch (statusCode) {
    case statusCodes.VALIDATION_ERROR:
      res.status(statusCode).json({
        title: "Validation error",
        message: err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;

    case statusCodes.UNAUTHORIZED:
      res.status(statusCode).json({
        title: "Unauthorized error",
        message: err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;

    case statusCodes.FORBIDDEN:
      res.status(statusCode).json({
        title: "Forbidden error",
        message: err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;

    case statusCodes.NOT_FOUND:
      res.status(statusCode).json({
        title: "Not found",
        message: "test".err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;

    case statusCodes.SERVER_ERROR:
      res.status(statusCode).json({
        title: "Server error",
        message: err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;

    default:
      res.status(500).json({
        title: "Unknown error",
        message: err.message,
        stackTrace: process.env.NODE_ENV === "production" ? null : err.stack,
      });
      break;
  }
};

export default errorHandler;
