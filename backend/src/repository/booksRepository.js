const Book = require('../app/models/Book');

const getAll = async () => await Book.findAll();

const getSpecificWithId = async (id) => await Book.findByPk(id);

const getSpecific = async (where) => await Book.findOne(where);


const save = async (data) => {
    const { name, author, category, uniqueCode, type, size, weight } = data;
    
   const book = await Book.create({name: name,
        author: author,
        category: category,
        unique_code: uniqueCode,
        type: type,
        size: size,
        weight: weight,});
    return book;
}
const put = async (data) => {
    const { name, author, category, uniqueCode, type, size, weight } = data;
    const book = new Book;
    book.name = name;
    book.author = author;
    book.category = category;
    book.unique_code = uniqueCode;
    book.type = type;
    book.size = size;
    book.weight = weight;

    bookCode = book.unique_code
    await Book.update({ book }, { where: { id: bookCode } });
    return book;
}
const remove = async where => await Book.destroy(where);

module.exports = {
    getAll,
    save,
    getSpecific,
    remove,
    getSpecificWithId,
    put
}