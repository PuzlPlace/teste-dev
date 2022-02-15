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
            data: [0],
            borderColor: "white",
            backgroundColor: "red",
          },
          {
            label: "Second Quarter",
            data: [0],
            borderColor: "white",
            backgroundColor: "blue",
          },
          {
            label: "Third Quarter",
            data: [],
            borderColor: "white",
            backgroundColor: "green",
          },
          {
            label: "Fourth Quarter",
            data: [0],
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
    async searchByDate() {
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

     const response = await Books.listAll()
     const booksFiltered = response.data.searched;
        jan = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 0
        ).length;
        feb = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 1
        ).length;
        mar = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 2
        ).length;
        apr = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 3
        ).length;
        may = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 4
        ).length;
        jun = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 5
        ).length;
        jul = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 6
        ).length;
        aug = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 7
        ).length;
        sep = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 8
        ).length;
        oct = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 9
        ).length;
        nov = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 10
        ).length;
        dec = booksFiltered.filter(
          (book) => new Date(book.createdAt).getMonth() === 11
        ).length;
        this.chartData.datasets[1].data[0] = jan + feb + mar;
        this.chartData.datasets[2].data[0] = apr + may + jun;
        this.chartData.datasets[3].data[0] = jul + aug + sep;
        this.chartData.datasets[4].data[0] = oct + nov + dec;


    },
  },
 async mounted() {
   await this.searchByDate();
    this.renderChart(this.chartData);
  },
};
</script>

