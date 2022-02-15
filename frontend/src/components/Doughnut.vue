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
            data: [1, 1, 1, 1],
          },
        ],

        labels: ["Thriller", "Science Fiction", "Horror", "Literary Fiction"],
      },
    };
  },
  extends: Doughnut,
  methods: {
    async searchCategory() {
      let countTrhiller = 0;
      let countHorror = 0;
      let countLiterary = 0;
      let countScience = 0;
      const response = await Books.listAll()
      const responseCategory = response.data.searched;
        countTrhiller = responseCategory.filter(
          (book) => book.category == "Thriller"
        ).length;
        countHorror = responseCategory.filter(
          (book) => book.category == "Horror"
        ).length;
        countLiterary = responseCategory.filter(
          (book) => book.category == "Literary Fiction"
        ).length;
        countScience = responseCategory.filter(
          (book) => book.category == "Science Fiction"
        ).length;
        
        return (this.chartData.datasets[0].data = [
          countTrhiller,
          countScience,
          countHorror,
          countLiterary,
        ]);
    },
  },
 async mounted() {
   await this.searchCategory();
    this.renderChart(this.chartData);
  },
};
</script>