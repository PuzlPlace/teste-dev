const BookRepository = require("../repository/booksRepository");
 
const getAllBooks = async () => await BookRepository.getAll();
  
const addBook = async (data) => await BookRepository.save(data);

const updatesBook = async (data) =>  await BookRepository.put(data);

const destroyBook = async (id) => await BookRepository.remove(id);

const specificBook = async (id) => await BookRepository.getSpecificWithId(id);   


module.exports ={
    getAllBooks,
    addBook,
    updatesBook,
    destroyBook,
    specificBook

}