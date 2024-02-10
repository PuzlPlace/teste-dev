<template>
  <form id="formId2" @submit.prevent="updateBook">
    <div class="bd-example bg-body-tertiary">
        <div class="modal position-static d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-10 titleModal" id="staticBackdropLabel">Editar Livro</h1>
                    </div>
                    <div class="modal-body">
                        <div>
                        <input type="text" id="title" name="title" v-model="livro.title" required/>
                        <span>Título</span>
                        </div>
                        <div>
                        <input type="text" id="author" name="author" v-model="livro.author" required/>
                        <span>Autor</span>
                        </div>
                        <div>
                            <div class="select"><h5>Categoria: </h5></div>
                            <select name="category" v-model="livro.category" required>
                                <option value="Fantasia">Fantasia</option>
                                <option value="Romance">Romance</option>
                                <option value="Suspense">Suspense</option>
                                <option value="Terror">Terror</option>
                            </select>
                        </div>
                        <div>
                            <div>Tipo do Livro:</div>
                            <div>
                                <input
                                    type="radio"
                                    id="three"
                                    value="Digital"
                                    v-model="livro.type"
                                    required
                                />
                                <label for="three">
                                    Digital
                                </label>
                            </div>
                            <div>
                                <input
                                    type="radio"
                                    id="four"
                                    value="Físico"
                                    v-model="livro.type"
                                    required
                                />
                                <label for="four">
                                    Físico
                                </label>
                            </div>
                            <input type="text" id="type" name="type" v-model="livro.size" required/>
                            <span>Tamanho</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning">Atualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
</template>

<script setup>
import { defineComponent, ref, onMounted, defineProps } from 'vue';
import { db } from '../firebase.js';
import { doc, updateDoc } from 'firebase/firestore';

const props = defineProps({
    data: Object,
    show: Boolean
})

defineComponent({
    name: 'UpdateBook',
})

onMounted(() => {
    if (props.data) {
        livro.value = { ...livro.value, ...props.data };
        console.log('Props.data:', props.data);
        console.log('Livro:', livro.value);
    } else {
        console.error('props.data is undefined');
    }
    console.log('Show: ', props.show)
})

const livro = ref({
    title: '',
    author: '',
    category: '',
    type: '',
    size: ''
})

function closeModal() {
    emit('close')
}

async function updateBook() {
    await updateDoc(doc(db, 'Livros', props.data.id), livro.value);
  
    setTimeout(() => {
        window.location.reload();
    }, 100);
};
</script>

<style scoped>
.bg-body-tertiary {
    --bs-bg-opacity: 0;
}
.modal-dialog {
    margin-left: 50px;
}
.modal-header {
  background-color: #ffc107;
  color: white;
}
.modal-title {
  margin-left: 7.5rem;
}
.modal-body {
  margin: 3px;
}
input[type="text"], select {
  margin-top: 20px;
  margin-bottom: 10px;
  border-radius: 5px;
  padding: 3px;
  width: 90%;
  font-size: 1em;
}
span {
  position: absolute;
  margin-top: 20px;
  left: 0;
  padding: 5px;
  margin-left: 20px;
  pointer-events: none;
  font-size: 1em;
  transition: 0.5s;
  text-transform: uppercase;
}
input:valid ~ span, input:focus ~ span
{
  color: white;
  transform: translateX(10px) translateY(-26px);
  font-size: 0.65em;
  background-color: #ffc107;
  border: 1px solid black;
  border-radius: 3px;
}
input[type="radio"]{
  margin: 10px;
}
</style>
