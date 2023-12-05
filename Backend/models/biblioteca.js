const mongoose = require("mongoose");

const { Schema } = mongoose;

const categoriaSchema = new Schema(
  {
    nome: {
      type: String,
    },
    autor: {
      type: String,
    },
    categoria: {
      type: String,
    },
    codigo: {
      type: mongoose.Schema.Types.Mixed
    },
    tipo: {
      type: String,
    },
    tamanho: {
      type: mongoose.Schema.Types.Mixed,
      min:0.5,
      max:1.5
    },
  },
  { timestamps: true }
);

const Categoria = mongoose.model("Categoria", categoriaSchema);

module.exports = Categoria;
