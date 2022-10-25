import AllBooks from "./components/AllBooks.vue";
import CreateBook from "./components/CreateBook.vue";
import ShowBook from "./components/ShowBook.vue";
import ReportBooks from "./components/ReportBooks.vue";

export default {
    routes: [
        {
            name: "home",
            path: "/",
            component: AllBooks,
        },
        {
            name: "create",
            path: "/create",
            component: CreateBook,
        },
        {
            name: "edit",
            path: "/edit/:id",
            component: ShowBook,
        },
        {
            name: "report",
            path: "/report",
            component: ReportBooks,
        },
    ],
};
