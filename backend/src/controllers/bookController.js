const BookRepository = require("../repository/booksRepository");
const BookServices = require("../services/bookServices")

const createBook = async (req, res) => {
    try {
        await BookServices.addBook(req.body)
        res.status(201).json({ message: 'Livro cadastrado com sucesso' });
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}

const readBook = async (req, res) => {
    try {
        const books = await BookServices.getAllBooks();
        res.status(200).json(books);
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}

const updateBook = async (req, res) => {
    const bookId = req.params.id;
    const bookFound = await BookServices.specificBook(bookId);
    try {
        if (bookFound) {
            await BookServices.updatesBook(req.body)
            res.status(200).json({ message: 'Livro Atualizado' });
        } else {
            res.status(404).json({ message: 'Livro não encontrado' });
        }
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}

const deleteBook = async (req, res) => {
    const bookId = req.params.id;
    try {
        const bookFound = await BookServices.specificBook(bookId);
        if (!bookFound) {
            res.status(404).json({ message: 'Livro não encontrado' });
        } else {
            await BookServices.destroyBook({ where: { id: bookId } })
            res.status(200).json({ message: 'Livro Deletado' });
        }
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }

}
module.exports = {
    createBook,
    readBook,
    updateBook,
    deleteBook
}