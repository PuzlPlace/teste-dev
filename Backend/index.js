//Importando o express
const express = require("express")
//Importar o cors
const cors = require("cors")
//Invoke Express
const app = express()

//Estamos usando o cors
app.use(cors())

//Permite comunicação via Json
app.use(express.json())

//DB Connection(importar a função)
const conn = require("./db/conn")

conn();



//Routes

const routes = require("./routes/router")

// dizer que estas rotas estarao na minha aplicação

app.use('/api',routes)

app.listen(3000,function(){
    console.log("Servidor Online")
})