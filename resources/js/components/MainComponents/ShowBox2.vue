<template>
    <div>
        <!-- <div class="d-flex justify-content-center" v-if="loadingCategory">
            <LoadingRollComponent />
        </div> -->

        <div class="d-flex">
            <div class="right">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="w-60">
                        <h2 class="font-weight-bold">{{ category.name }}</h2>
                        <h6 class="font-weight-bold">
                            {{ category.mini_description }}
                        </h6>
                        <!-- <div class="stars">
                        <i v-for="n in 5" :key="n" class="far fa-star"></i>
                    </div> -->
                        <div class="d-flex align-items-center">
                            <span>da </span>
                            <h3 class="p-2 font-weight-bold">
                                € {{ minimumPrice }}
                            </h3>
                            <span>IVA esclusa</span>
                        </div>
                        <span>
                            {{ category.description }}
                        </span>
                    </div>
                    <div class="w-25 position-relative">
                        <img class="img-fluid" :src="category.img" alt="" />
                        <img
                            class="logo img-fluid position-absolute"
                            :src="category.img2"
                            alt=""
                        />
                    </div>
                </div>

                <!-- <div class="d-flex text-center fs-5">
                    <div class="orange w-60 p-2 m-1">
                        <i class="fas fa-info-circle"> </i
                        ><strong> SCONTO </strong><span>FOX</span
                        ><strong>TOP </strong>
                        <span>
                            > Seleziona per vedere il prezzo in anteprima
                        </span>
                    </div>
                    <div class="orange w-20 p-2 m-1">
                        <input type="checkbox" />
                        <strong> SCONTO 5%</strong> Totale ordine fino a €999
                    </div>
                    <div class="orange w-20 p-2 m-1">
                        <input type="checkbox" />
                        <strong>SCONTO 10%</strong> Totale ordine da €1.000
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            value: 100,
            category: {},
            loadingCategory: true,
        };
    },
    methods: {
        increaseValue() {
            this.value += 10;
        },
        decreaseValue() {
            this.value -= 10;
        },
        getCategory() {
            console.log(this.loadingCategory);
            this.loadingCategory = true;
            axios
                .get(`/api/categories/${this.$route.params.id}`)
                .then((response) => {
                    this.category = response.data.results;
                    console.log(this.category);
                    setTimeout(() => {
                        console.log(this.loadingCategory);
                        this.loadingCategory = false;
                    }, 1000);
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
    },
    created() {
        this.getCategory();
    },
    mounted() {
        window.scrollTo(0, 0);
    },
    computed: {
        minimumPrice() {
            console.log(
                this.category.products.map((product) =>
                    Math.min(product.price, product.price_saled)
                )
            );
            return Math.min(
                ...this.category.products.map((product) =>
                    product.price_saled === null
                        ? product.price
                        : Math.min(product.price, product.price_saled)
                )
            );
        },
    },
};
</script>

<style lang="scss" scoped>
.logo {
    height: 120px;
    right: 10px;
    top: 10px;

    // border: 5px solid white;
    // border-radius: 50%;
}
span {
    font-size: 0.8rem;
}
input[type="checkbox"] {
    border: 0;
    width: 20px;
    height: 20px;
}
// NAV BAR
nav {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 1rem;
    margin: 1rem;
    border-bottom: 1px solid lightgray;

    a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        font-size: 0.8rem;
        transition: all 0.2s;

        &:hover {
            color: #0076ff;
        }

        &.active {
            border-bottom: 5px solid #000;
        }
    }
}

// TABLE
table {
    width: -webkit-fill-available;
}

.alternating-rows tr:nth-child(odd) {
    background-color: rgba(211, 211, 211, 0.5);
}

.alternating-rows tr:nth-child(even) {
    background-color: white;
}

td {
    padding: 8px;
}

.td1 {
    font-weight: bold;
    width: 30%;
}

.td2 {
    color: orange;
    font-weight: bold;
}
</style>
