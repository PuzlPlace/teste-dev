const express = require("express");
const router = express.Router();
const bookController = require("../controllers/bookController.js");

router.post("/book/create", bookController.createBook);
router.get("/books", bookController.readBook);
router.put("/book/update/:id",  bookController.updateBook);
router.delete("/book/delete/:id", bookController.deleteBook);





module.exports = router;
