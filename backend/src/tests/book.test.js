const request = require("supertest");
const app = require("../../src/app");
const BookRepository = require("../repository/booksRepository");


describe("Post Create a Book --> /api/v1/book/create", () => {
    it('Create an book', async () => {
      const random =  Math.floor(Math.random() * (1000 - 10)) + 10;
        return await request(app).post('/api/v1/book/create').send({
            name: 'name',
            author: 'author',
            category: 'Thriller',
            uniqueCode: random,
            type: 'digital',
            size: 500,
            weight: 30,
        }).expect("Content-Type", /json/)
            .expect(201)
    });
    afterAll(async () => {
        await BookRepository.remove({ where: { uniqueCode: 41234 } });
    });
});
describe("Get all books --> /api/v1/books", () => {
    const books = BookRepository.getAll();
    it("Gets an array of books", async () => {
        await books;
            return await request(app)
            .get("/api/v1/books/paginated")
            .expect("Content-Type", /json/)
            .expect(200)
    });
});
describe("Update a book --> /api/v1/book/update/:id", () => {
    const bookFound = BookRepository.getSpecificWithId(1)
    it("Updates an specific book", async () => {
        await bookFound;
        return await request(app).put('/api/v1/book/update/1').send({
            name: 'name',
            author: 'author',
            category: 'Thriller',
            uniqueCode: 4124,
            type: 'digital',
            size: 500,
            weight: null,
        })
            .expect("Content-Type", /json/)
            .expect(200)
            .expect({ message: 'Updated Book' })
    });
    it("Book not found", async () => {
        return await request(app).put('/api/v1/book/update/9990')
        .expect("Content-Type", /json/)
        .expect(404)
        .expect({ message: 'Book not Found'})
    });
});
describe("Delete a book -->  /api/v1/book/delete/:id", () =>{
    beforeAll(async () => {
     const bookData = {
            name: 'name',
            author: 'author',
            category: 'Thriller',
            uniqueCode: 541234,
            type: 'digital',
            size: 500,
            weight: null,
        }
       return await BookRepository.save(bookData)
    });
    it("Deletes an specific book", async () =>{
        const bookFound = await BookRepository.getSpecific({where: {uniqueCode: 541234 }});
        const bookId = bookFound.id;
        return await request(app).delete(`/api/v1/book/delete/${bookId}`)
        .expect("Content-Type", /json/)
        .expect(200)
        .expect({ message: 'Book Deleted' })

    })
    it("Book not found", async () => {
        return await request(app).delete('/api/v1/book/delete/999000')
        .expect("Content-Type", /json/)
        .expect(404)
        .expect({ message: 'Book not Found'})
    });
})

describe("Gets a book --> /api/v1/book/:id", () => {
    const bookFound = BookRepository.getSpecificWithId(1)
    it("Updates an specific book", async () => {
        await bookFound;
        return await request(app).get('/api/v1/book/1')
            .expect("Content-Type", /json/)
            .expect(200)
    });
    it("Book not found", async () => {
        return await request(app).get('/api/v1/book/9990')
        .expect("Content-Type", /json/)
        .expect(404)
        .expect({ message: 'Book not Found'})
    });
});