<template>
  <div>
    <b>{{ this.error }}</b>
    <form @submit.prevent="update(id)">
      <div class="form-group">
        <label for="name">Book Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Book Name"
          v-model="book.name"
        />
      </div>
      <div class="form-group">
        <label for="author">Author Name</label>
        <input
          type="text"
          class="form-control"
          id="author"
          placeholder="Enter Author Name"
          v-model="book.author"
        />
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <input
          type="text"
          class="form-control"
          id="category"
          placeholder="Enter "
          v-model="book.category"
        />
      </div>
      <div class="form-group">
        <label for="uniqueCode">Unique Code</label>
        <input
          type="number"
          class="form-control"
          id="uniqueCode"
          placeholder="Enter uniqueCode"
          v-model="book.uniqueCode"
        />
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <input
          type="text"
          class="form-control"
          id="type"
          placeholder="Enter type"
          v-model="book.type"
        />
      </div>
      <div class="form-group">
        <label for="size">Size</label>
        <input
          type="text"
          class="form-control"
          id="size"
          placeholder="Enter size"
          v-model="book.size"
        />
      </div>
      <div class="form-group">
        <label for="weight">Weight</label>
        <input
          type="number"
          class="form-control"
          id="weight"
          placeholder="Enter weight"
          v-model="book.weight"
        />
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>
<script>
import Books from "../services/books";
export default {
  data() {
    return {
      book: {
        id: "",
        name: "",
        author: "",
        category: "",
        uniqueCode: "",
        type: "",
        size: "",
        weight: "",
      },
      error: "",
      id: "",
    };
  },
  created() {
    this.id =this.$route.params.id;
    this.oneBook(this.id);
  },
  methods: {
    update(id) {
      Books.updateBook(this.book, id)
        .then((response) => {
          console.log(response)
          alert(response.data.message);
          this.$router.push("/");
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    oneBook(id) {
      Books.specificBook(id)
        .then((response) => {
          this.book = response.data;
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  },
};
</script>
