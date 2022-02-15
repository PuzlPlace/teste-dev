const express = require("express");
const router = express.Router();
const bookController = require("../controllers/bookController.js");



router.post("/book/create", bookController.createBook);
router.get("/books/paginated", bookController.readBooksPaginated);
router.put("/book/update/:id",  bookController.updateBook);
router.delete("/book/delete/:id", bookController.deleteBook);
router.get("/book/:id", bookController.specificBook);
router.get("/books/search", bookController.readBooks);







module.exports = router;
