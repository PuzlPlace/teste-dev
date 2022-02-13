<template>
  <div>
    <b>{{ this.error }}</b>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Unique Code</th>
          <th scope="col">Type</th>
          <th scope="col">Size</th>
          <th scope="col">Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book of books" :key="book.id">
          <th scope="row">{{ book.id }}</th>
          <td>{{ book.name }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.category }}</td>
          <td>{{ book.uniqueCode }}</td>
          <td>{{ book.type }}</td>
          <td>{{ book.size }}</td>
          <td>{{ book.weight }}</td>
          <td>
            <a :href="'/update/' + book.id" class="btn btn-primary">Edit</a>
            <button @click="remove(book.id)" class="btn btn-danger">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import Books from "../services/books";
export default {
  data() {
    return {
      books: [],
      error: "",
    };
  },
  methods: {
    remove(id) {
      Books.removeBook(id)
        .then((response) => {
          alert(response.data.message);
           this.listBooks();
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    listBooks() {
      Books.list().then((response) => {
        this.books = response.data;
      });
    },
  },
  mounted() {
    this.listBooks();
  },
};
</script>
