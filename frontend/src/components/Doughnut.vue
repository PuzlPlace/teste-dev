<script>
import { Doughnut } from "vue-chartjs";
import Books from "../services/books";

export default {
  data() {
    return {
      chartData: {
        datasets: [
          {
            backgroundColor: ["red", "yellow", "blue", "green"],
            data: [1,1,1,1],
          },
        ],

        labels: ["Thriller", "Science Fiction", "Horror", "Literary Fiction"],
      },
      trhiller: "",
      countTrhiller: "",
      scienceFiction: "",
      horror: "",
      literaryFiction: "",
      searched: "",
    };
  },
  extends: Doughnut,
  methods: {
    searchCategory() {
      let countTrhiller = 0;
      let countHorror = 0;
      let countLiterary = 0;
      let countScience = 0;
      Books.listAll().then((response) => {
        const booksFiltered = response.data.searched;
        countTrhiller = booksFiltered.filter(
          (book) => book.category == "Thriller"
        ).length;
        countHorror = booksFiltered.filter(
          (book) => book.category == "Horror"
        ).length;
        countLiterary = booksFiltered.filter(
          (book) => book.category == "Literary Fiction"
        ).length;
        countScience = booksFiltered.filter(
          (book) => book.category == "Science Fiction"
        ).length;

        return this.chartData.datasets[0].data = [
          countTrhiller,
          countScience,
          countHorror,
          countLiterary,
        ];
      });
    },
  },
  mounted() {
    this.searchCategory();
    this.renderChart(this.chartData);

  },
};
</script>