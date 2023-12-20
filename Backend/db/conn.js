// importar o mongoose
const mongoose = require("mongoose")

//conectar com o banco
async function main(){
    try {
        await mongoose.connect("mongodb+srv://admin:admin@cluster0.pyrxoqk.mongodb.net/?retryWrites=true&w=majority");

        console.log("Conectado ao banco");

    } catch (error) {
        console.log(`Erro:${error}`)
    }
}

//exportar esta função assincrona
module.exports = main