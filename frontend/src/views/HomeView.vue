<template>
  <div class="main">
    <div class="row">
      <form inline>
        <div class="col">
          Book Name
          <input
            id="name"
            class="form-control col"
            placeholder="Book Name"
            v-model="search"
          />
        </div>
        <div class="col">
          Book Category
          <select class="form-select col" v-model="selectedCategory">
            <option value="Select Category">Select Category</option>
            <option value="Thriller">Thriller</option>
            <option value="Science Fiction">Science Fiction</option>
            <option value="Horror">Horror</option>
            <option value="Literary Fiction">Literary Fiction</option>
          </select>
        </div>
        <div class="col">
          Book Type
          <select class="form-select col" v-model="selectedType">
            <option value="Select Category">Select Type</option>
            <option value="digital">Digital</option>
            <option value="physical">Physical</option>
          </select>
        </div>
        <div class="col">
          <button
            title="Clear Filter"
            class="btn btn-secondary clear"
            @click="clearFilter"
          >
            Clear Filter
          </button>
        </div>
      </form>
    </div>
    <div>
      <b>{{ this.error }}</b>
      <table class="table table-bordered table-primary">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Unique Code</th>
            <th scope="col">Type</th>
            <th scope="col">Size(MB)</th>
            <th scope="col">Weight(g)</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book of booksFiltered" :key="book.id">
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
    <ul class="pagination justify-content-center">
      <li v-for="(page, index) of pages" :key="index" class="page-item">
        <a class="page-link" :href="'/?page=' + page">{{ page }}</a>
      </li>
    </ul>
  </div>
</template>
<script>
import Books from "../services/books";
export default {
  data() {
    return {
      books: [],
      error: "",
      pageParam: "",
      pages: "",
      size: "",
      search: "",
      selectedCategory: null,
      selectedType: null,
      options: [
        { value: null, text: "Select a book type" },
        { value: "digital", text: "Digital" },
        { value: "physical", text: "Physical" },
      ],
    };
  },
  computed: {
    booksFiltered() {
      let filtered = [];
      filtered = this.books.filter((book) => {
        return book.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
      });

      filtered = filtered.filter((book) => {
        if (this.selectedCategory === null) {
          return book;
        } else {
          return book.category == this.selectedCategory;
        }
      });
      filtered = filtered.filter((book) => {
        if (this.selectedType === null) {
          return book;
        } else {
          return book.type == this.selectedType;
        }
      });

      return filtered;
    },
  },
  methods: {
    remove(id) {
      Books.removeBook(id)
        .then((response) => {
          alert(response.data.message);
          this.listBooks(this.pageParam);
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    listBooks(pagination) {
      Books.list(pagination).then((response) => {
        this.books = response.data.books;
        this.pages = response.data.countPages;
      });
    },
    clearFilter() {
      this.search = "";
      this.selected = null;
    },
  },
  mounted() {
    this.pageParam = this.$route.query.page;
    if (!this.pageParam) {
      this.pageParam = 1;
    }
    this.listBooks(this.pageParam);
  },
};
</script>
<style scoped>
.col {
  display: inline-block;
}
table {
  margin-top: 20px;
}
.form-control,
.form-select {
  width: 50%;
}
.main {
  padding: 40px;
}
.clear {
  width: 90px;
  height: 50%;
  font-size: 12px;
}
</style>
