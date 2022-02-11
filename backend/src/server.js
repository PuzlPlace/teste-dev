const app = require("./app.js");
require("dotenv").config();

//Database Connection
const db = require("./config/database");
db.authenticate()
    .then(() => {
        console.log("Database connected...");
    })
    .catch((err) => {
        console.log("Error: " + err);
    });

const PORT = process.env.PORT || 5000;
db.sync()
    .then(() => {
        app.listen(PORT, console.log(`Server started on port ${PORT}`));
    })
    .catch((err) => console.log("Error: " + err));

