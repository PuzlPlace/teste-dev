<script>
import { Bar, mixins } from "vue-chartjs";
import Books from "../services/books";

export default {
  data() {
    return {
      chartData: {
        labels: ["Quarters of the year"],
        datasets: [
          {
            label: "",
            data: [0],
          },
          {
            label: "First Quarter",
            data: [2],
            borderColor: "white",
            backgroundColor: "red",
          },
          {
            label: "Second Quarter",
            data: [2],
            borderColor: "white",
            backgroundColor: "blue",
          },
          {
            label: "Third Quarter",
            data: [2],
            borderColor: "white",
            backgroundColor: "green",
          },
          {
            label: "Fourth Quarter",
            data: [3],
            borderColor: "white",
            backgroundColor: "Yellow",
          },
        ],
      },
      feb: "",
    };
  },
  extends: Bar,
  methods: {
    searchByDate() {
      let jan = 0;
      let feb = 0;
      let mar = 0;
      let apr = 0;
      let may = 0;
      let jun = 0;
      let jul = 0;
      let aug = 0;
      let sep = 0;
      let oct = 0;
      let nov = 0;
      let dec = 0;

      Books.listAll().then((response) => {
        const booksFiltered = response.data.searched;
        jan = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 0
        );
        feb = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 1
        );
        mar = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 2
        );
        apr = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 3
        );
        may = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 4
        );
        jun = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 5
        );
        jul = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 6
        );
        aug = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 7
        );
        sep = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 8
        );
        oct = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 9
        );
        nov = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 10
        );
        dec = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 11
        );
        // this.chartData.datasets[1].data[0] = feb;
      });
    },
  },
  mounted() {
    this.renderChart(this.chartData);
    this.searchByDate();
    console.log(this.chartData.datasets[1].data[0]);
  },
};
</script>

