const router = require("express").Router();
const Categoria = require("../models/biblioteca");

// vai atrelar cada rota uma função do controller
const bibliotecaController = require("../controller/bibliotecaController");

router.post("/bibliotecaRouter", (req, res) =>
  bibliotecaController.create(req, res)
);

// uma nova rota pra trazer os dados da api
router.get("/bibliotecaRouter", (req, res) =>
  bibliotecaController.getAll(req, res)
);

// uma nova rota pra deletar dados da api
router.delete("/bibliotecaRouter/:idLivro", async (req, res) => {
  const { idLivro } = req.params;

  try {
    const livroRemovido = await Categoria.findByIdAndDelete(idLivro);
    if (!livroRemovido) {
      return res.status(404).send("Livro não encontrado");
    }
    res.status(200).send("Livro removido com sucesso");
  } catch (error) {
    console.error("Erro ao excluir o livro:", error);
    res.status(500).send("Erro ao excluir o livro");
  }
});

router.patch("/bibliotecaRouter/:idLivro", (req, res) =>
  bibliotecaController.update(req, res)
);

//exportar este router para poder usar na aplicação
module.exports = router;
