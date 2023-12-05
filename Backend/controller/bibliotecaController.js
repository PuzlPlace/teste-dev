// controller/categoriaController.js
const Biblioteca = require('../models/biblioteca');

const bibliotecaController = {
    create: async (req, res) => {
        try {

            const codigoAleatorio = generateRandomCode(6);

            const bibliotecas = {
                id: req.body.id,
                nome: req.body.nome,
                autor: req.body.autor,
                categoria: req.body.categoria,
                codigo: codigoAleatorio,
                tipo: req.body.tipo,
                tamanho: req.body.tamanho,
            };

            const response = await Biblioteca.create(bibliotecas);

            res.status(201).json({ response, msg: "Categoria criada com sucesso" });
        } catch (error) {
            console.log(error);
            res.status(500).json({ error: "Erro interno do servidor" });
        }
    },
    // vai pegar todos os registros que tem na Api relacionados a categorias
    getAll: async(req,res)=>{
        try {
            const bibliotecas = await Biblioteca.find()
            // vai enviara para o frontend
            res.json(bibliotecas)
        } catch (error) {
            console.log(error)
        }
    },
    get: async (req,res)=>{
        try {
            const id = req.params._id

            //resgatar a categoria do banco
            const biblioteca= await Biblioteca.findById(id)

            if(!biblioteca){
                res.status(404).json({msg:"Livro nao encontrada"})
                return;
            }

            res.json(biblioteca)

        } catch (error) {
            console.log(error);
        }
    },
    async update(req, res) {
        const { idLivro } = req.params;
        const { nome, autor, categoria, tipo } = req.body;
    
        try {
            console.log('ID do Livro recebido:', idLivro);
            console.log('Dados recebidos:', req.body);
          const livroAtualizado = await Biblioteca.findByIdAndUpdate(
            idLivro,
            { nome, autor, categoria, tipo },
            { new: true } // Retorna o documento atualizado
          );

          console.log(livroAtualizado);
    
          if (!livroAtualizado) {
            return res.status(404).send('Livro não encontrado');
          }
          console.log('Livro atualizado:', livroAtualizado);
          res.status(200).json(livroAtualizado);
        } catch (error) {
          console.error('Erro ao atualizar o livro:', error);
          res.status(500).send('Erro ao atualizar o livro');
        }
      }

};
function generateRandomCode(length) {
    const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}

module.exports = bibliotecaController;
