<template>
  <div class="main-div">
    <b>{{ this.error }}</b>
    <form @submit.prevent="save">
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
        <label for="size">Size(MB)</label>
        <input
          type="text"
          class="form-control"
          id="size"
          placeholder="Enter size"
          v-model="book.size"
        />
      </div>
      <div v-else class="form-group">
        <label for="weight">Weight(g)</label>
        <input
          type="number"
          class="form-control"
          id="weight"
          placeholder="Enter weight"
          v-model="book.weight"
        />
      </div>
      <button type="submit" class="btn btn-success">Create</button>
    </form>
  </div>
</template>
<script>
import Books from "../services/books";
export default {
  data() {
    return {
      book: {
        name: "",
        author: "",
        category: "Select Category",
        uniqueCode: "",
        type: "digital",
        size: null,
        weight: null,
      },
      error: "",
      digital: true,
      physical: false,
    };
  },
  methods: {
    save() {
      Books.saveBook(this.book)
        .then((response) => {
          alert(response.data.message);
          this.$router.push("/");
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  },
};
</script>
<style>
.form-group,
.form-select {
  margin-bottom: 15px;
}

.form-check {
  display: inline-block;
  margin-bottom: 15px;
}
.btn{
  margin-bottom: 15px;;
}
.main-div{
  padding-left: 20px;
}
</style>