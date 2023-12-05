const router = require("express").Router();

// Biblioteca router
const bibliotecaRouter = require("./bibliotecaRouter");

router.use("/", bibliotecaRouter);

module.exports = router;
