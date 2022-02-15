const BookServices = require("../services/bookServices")
const { bookSchema } = require("../validation/books/book.schema");


const createBook = async (req, res) => {
    try {
        await bookSchema.validateAsync(req.body);
        await BookServices.addBook(req.body)
        res.status(201).json({ message: 'Book Created' });
    } catch (error) {
        if (error.isJoi === true) {
            res.status(422).json({ message: 'Erro: ' + error })
        } else {
            res.status(500).json({ message: 'Erro: ' + error })
        }
    }
}

const readBooksPaginated = async (req, res) => {
    try {
        let { page, size } = req.query
        if (!page) {
            page = 1;
        }
        if (!size) {
            size = 5;
        }
        const limit = parseInt(size);
        const skip = (page - 1) * size;
        const pages = await BookServices.booksCount();
        const countPages = Math.ceil((pages.count) / size);
        const books = await BookServices.getAllBooks(limit, skip);
        res.status(200).json({
            page,
            size,
            countPages,
            books
        });
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}

const updateBook = async (req, res) => {
    const bookId = req.params.id;

    const bookFound = await BookServices.specificBook(bookId);
    try {
        if (bookFound) {
            const updatedBook = await BookServices.updatesBook(req.body, bookId)
            res.status(200).json({ updatedBook, message: 'Updated Book' });
        } else {
            res.status(404).json({ message: 'Book not Found' });
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
            res.status(404).json({ message: 'Book not Found' });
        } else {
            await BookServices.destroyBook({ where: { id: bookId } })
            res.status(200).json({ message: 'Book Deleted' });
        }
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }

}

const specificBook = async (req, res) => {
    const bookId = req.params.id;
    try {
        const bookFound = await BookServices.specificBook(bookId);
        if (!bookFound) {
            res.status(404).json({ message: 'Book not Found' });
        } else {
            res.status(200).json(bookFound);
        }
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}

const readBooks = async (req, res) => {
    try {
        const searched = await BookServices.getAllBooks();
        res.status(200).json({
            searched,
        });
    } catch (error) {
        res.status(500).json({ message: 'Erro: ' + error })
    }
}
module.exports = {
    createBook,
    readBooksPaginated,
    updateBook,
    deleteBook,
    specificBook,
    readBooks,
}
