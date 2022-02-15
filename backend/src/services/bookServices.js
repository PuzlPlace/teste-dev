const BookRepository = require("../repository/booksRepository");
 
const getAllBooks = async (limit,skip) => await BookRepository.getAll(limit,skip);
  
const addBook = async (data) => await BookRepository.save(data);

const updatesBook = async (data, id) =>  await BookRepository.put(data, id);

const destroyBook = async (id) => await BookRepository.remove(id);

const specificBook = async (id) => await BookRepository.getSpecificWithId(id);   

const booksCount = async () => await BookRepository.getAllAndCount();



module.exports ={
    getAllBooks,
    addBook,
    updatesBook,
    destroyBook,
    specificBook,
    booksCount,
}