export default {
    data: () => ({
        categories: [],
        loadingCategories: true,
    }),
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            this.loadingCategories = true;
            axios
                .get("/shop/categories", {})
                .then((response) => {
                    this.categories = response.data.results.data;
                    this.loadingCategories = false;
                })
                .catch((error) => {
                    console.error(error.message);
                });
        },
    },
};
