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
      Category
      <select
        class="form-select form-select-sm"
        aria-label=".form-select-sm"
        v-model="book.category"
      >
        <option value="Select Category">Select Category</option>
        <option value="Thriller">Thriller</option>
        <option value="Science Fiction">Science Fiction</option>
        <option value="Horror">Horror</option>
        <option value="Literary Fiction">Literary Fiction</option>
      </select>
      <div class="form-group">
        <label for="uniqueCode">Unique Code</label>
        <input
          type="number"
          class="form-control"
          id="uniqueCode"
          placeholder="Enter Unique Code"
          v-model="book.uniqueCode"
        />
      </div>
      Type:
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="digital"
          id="digital"
          value="digital"
          v-model="book.type"
        />
        <label class="form-check-label" for="digital"> Digital </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="physical"
          id="physical"
          value="physical"
          v-model="book.type"
        />
        <label class="form-check-label" for="physical"> Physical </label>
      </div>
      <div v-if="book.type == 'digital'" class="form-group">
        <label for="size">Size</label>
        <input
          type="text"
          class="form-control"
          id="size"
          placeholder="Enter size"
          v-model="book.size"
        />
      </div>
      <div v-else class="form-group">
        <label for="weight">Weight</label>
        <input
          type="number"
          class="form-control"
          id="weight"
          placeholder="Enter weight"
          v-model="book.weight"
        />
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
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
    this.id = this.$route.params.id;
    this.oneBook(this.id);
  },
  methods: {
    update(id) {
      Books.updateBook(this.book, id)
        .then((response) => {
          console.log(response);
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
