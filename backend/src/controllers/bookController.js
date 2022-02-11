const Book  = require('../app/models/Book');

const createBook = async (req,res)=>{
    const {name, author, category, 
        uniqueCode, type, size, weight} = req.body
        const bookData = 
            {
                name: name,
                author: author,
                category: category,
                unique_code: uniqueCode,
                type: type,
                peso: null,
                size: size,
                weight: weight
            };
     try{
        await Book.create(bookData);
        res.status(201).json({message: 'Livro cadastrado com sucesso'});
     }catch(error){
         res.status(500).json({message: 'error: ' + error})
     }
  
}

module.exports = {
    createBook,
}