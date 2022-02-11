const Sequelize = require("sequelize");
const db = require("../../config/database");


const Book = db.define("book", {
    name: Sequelize.STRING,
    author: Sequelize.STRING,
    category: Sequelize.STRING,
    unique_code: Sequelize.INTEGER,
    type: Sequelize.STRING,
    size: Sequelize.STRING,
    weight: Sequelize.INTEGER
  });

  module.exports = Book;