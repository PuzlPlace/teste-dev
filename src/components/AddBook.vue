<template>
  <button type="button" class="btn btn-success btn-sm buttonAdd" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
        >
            Adicionar Livro
        </button>
  <form id="formId" @submit.prevent="addNewBook">
    <div
        class="modal fade"
        ref="myModal"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-10 titleModal" id="staticBackdropLabel">Livro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                id="one"
                                value="Digital"
                                v-model="livro.type"
                                required
                            />
                            <label for="one">
                                Digital
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                id="two"
                                value="Físico"
                                v-model="livro.type"
                                required
                            />
                            <label for="two">
                                Físico
                            </label>
                        </div>
                        <input type="text" id="type" name="type" v-model="livro.size" required/>
                        <span>Tamanho</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
  </form>
</template>

<script>
import { defineComponent, ref, watch } from 'vue';
import { db } from '../firebase.js';
import { addDoc, collection } from 'firebase/firestore';

export default {
  props: {
    data: Object,
    isNew: Boolean
  },
  setup(props) {
    const livro = ref({
      title: '',
      author: '',
      category: '',
      type: '',
      size: ''
    });

    // Use watch para reagir sempre que a propriedade data mudar
    watch(() => props.data, (newData) => {
      // Verifica se a propriedade data foi passada e é um objeto válido
      if (newData && typeof newData === 'object') {
        // Atualiza o objeto livro com os novos dados recebidos
        Object.assign(livro.value, newData);
      }
    }, { immediate: true }); // immediate: true para que a função watch seja chamada imediatamente

    defineComponent({
    name: 'AddBook'
    })

    // onMounted(() => {
    //   livro.value = { ...livro.value, ...props.data };
    //   console.log(livro.value);
    // });

    const addNewBook = async () => {
      await addDoc(collection(db, 'Livros'), livro.value)
      
        // await updateDoc(doc(db, 'Livros', props.data.id), livro.value)
      
      setTimeout(() => {
        window.location.reload();
      }, 100);
    };

    return {
      livro,
      addNewBook,
    };
  }
};
</script>

<style scoped>
.buttonAdd {
   background-color: rgb(255, 110, 110);
   font-size: large;
   color: rgb(255, 255, 255);
   border-radius: 2.5mm;
   border: 0cap;
}
.buttonAdd:hover {
    background-color: rgb(106, 24, 24);
}
.modal-header {
  background-color: rgb(198, 108, 108);
  color: white;
}
.modal-title {
  margin-left: 11rem;
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
  background-color: rgb(198, 108, 108);
  border: 1px solid black;
  border-radius: 3px;
}
input[type="radio"]{
  margin: 10px;
}
</style>