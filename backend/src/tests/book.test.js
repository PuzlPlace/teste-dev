const request = require("supertest");
const app = require("../../src/app");
const BookRepository = require("../repository/booksRepository");


describe("Post Create a Book --> /api/v1/book/create", () => {
    it('Create an book', async () => {
        return await request(app).post('/api/v1/book/create').send({
            name: 'name',
            author: 'author',
            category: 'category',
            uniqueCode: 41234,
            type: 'digital',
            size: '500mb',
            weight: null,
        }).expect("Content-Type", /json/)
            .expect(201)
    });
    afterAll(async () => {
        await BookRepository.remove({ where: { unique_code: 41234 } });
    });
});
describe("Get all books --> /api/v1/books", () => {
    const books = BookRepository.getAll();
    it("Gets an array of books", async () => {
        await books;
        if(books.length > 0){
            return await request(app)
            .get("/api/v1/books")
            .expect("Content-Type", /json/)
            .expect(200)
            .expect.arrayContaining([
                expect.objectContaining({
                    name:  expect.any(String),
                    author:  expect.any(String),
                    category:  expect.any(String),
                    uniqueCode: expect.any(Number),
                    type: expect.any(String),
                    size:  expect.any(String),
                    weight:  expect.any(Number),
                }),
            ]);
        }
    });
});
describe("Update a book --> /api/v1/book/update/:id", () => {
    const bookFound = BookRepository.getSpecificWithId(3)
    it("Updates an specific book", async () => {
        await bookFound;
        return await request(app).put('/api/v1/book/update/3').send({
            name: 'name',
            author: 'author',
            category: 'category',
            uniqueCode: 4124,
            type: 'digital',
            size: '500mb',
            weight: 15,
        })
            .expect("Content-Type", /json/)
            .expect(200)
            .expect({ message: 'Livro Atualizado' })
    });
    it("Book not found", async () => {
        return await request(app).put('/api/v1/book/update/9990')
        .expect("Content-Type", /json/)
        .expect(404)
        .expect({ message: 'Livro não encontrado'})
    });
});
describe("Delete a book -->  /api/v1/book/delete/:id", () =>{
    beforeAll(async () => {
     const bookData = {
            name: 'name',
            author: 'author',
            category: 'category',
            uniqueCode: 541234,
            type: 'digital',
            size: '500mb',
            weight: null,
        }
       return await BookRepository.save(bookData)
    });
    it("Deletes an specific book", async () =>{
        const bookFound = await BookRepository.getSpecific({where: {unique_code: 541234 }});
        const bookId = bookFound.id;
        return await request(app).delete(`/api/v1/book/delete/${bookId}`)
        .expect("Content-Type", /json/)
        .expect(200)
        .expect({ message: 'Livro Deletado' })

    })
    it("Book not found", async () => {
        return await request(app).delete('/api/v1/book/delete/999000')
        .expect("Content-Type", /json/)
        .expect(404)
        .expect({ message: 'Livro não encontrado'})
    });
})