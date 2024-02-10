<template>
  <div>
    <update-book v-if="show" :data="data"/>
    <div v-for="livro in Livros" :key="livro.id" >
      <div class="card-columns">
        <div class="card" style="width: 100vh;">
          <div class="card-header">
            <div><h2>{{ livro.title }}</h2></div>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Autor:</b> {{ livro.author }}</li>
              <li class="list-group-item"><b>Categoria:</b> {{ livro.category }}</li>
              <li class="list-group-item"><b>Tipo:</b> {{ livro.type }}</li>
              <li class="list-group-item"><b>Tamanho:</b> {{ livro.size }}</li>
    
            </ul>
            <div class="deleteEdit">
              <a href="#" class="btn btn-danger" @click.stop="deleteRecord(livro.id)">Delete</a>
              <a 
                href="#" 
                class="btn btn-warning editButton"
                @click="openModal(livro)"
              >
                Editar
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script setup>
import {db} from '../firebase.js'
import {getDocs, collection, deleteDoc, doc } from 'firebase/firestore'
import {ref, onMounted } from 'vue'
import UpdateBook from './UpdateBook.vue'

const Livros = ref([])
const data = ref({})
const show = ref(false)

const openModal = (docData = {}) => {
  data.value = docData;
  show.value = !show.value;
  console.log("data2: ", docData);
  console.log("dataValue: ", data.value);
  console.log("show2: ", show.value);
}

onMounted(async() => {
  let bookCollection = await getDocs(collection(db, 'Livros'))
  bookCollection.forEach((livro) => {
    Livros.value.push({...livro.data(), id: livro.id})
  });
  console.log("data1: ", data.value),
  console.log("show1: ", show.value)
}

)

async function deleteRecord(id) {
  await deleteDoc(doc(db, 'Livros', id)),
  setTimeout(() => {
        window.location.reload();
      }, 100);
}
</script>

<style>
.deleteEdit {
  align-items: end;
}
.card {
  margin: 20px;
  margin-left: 50px;
}
.editButton {
  margin-left: 8px;
}
</style>

