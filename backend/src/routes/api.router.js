const express = require("express");
const router = express.Router();
const bookController = require("../controllers/bookController.js");

router.post("/book/create", bookController.createBook);


module.exports = router;
