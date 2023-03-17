<template>
    <div class="HeaderTop d-flex align-items-center top-navbar">
        <div class="container-lg">
            <div class="row justify-content-between">
                <section class="col-3 col-lg-3 d-none d-lg-block">
                    <div id="free" class="d-flex align-items-center">
                        <div>
                            <img
                                alt=""
                                class="img-fluid"
                                src="../../../../public/Links/header/consegna-gratuita.png"
                            />
                        </div>
                        <div class="d-none d-lg-inline">
                            <p>SEI UN NUOVO CLIENTE?</p>
                            <p>
                                <strong>
                                    SPEDIZIONE GRATIS IN TUTTA ITALIA
                                </strong>
                            </p>
                        </div>
                    </div>
                </section>
                <section class="col-3 col-lg-3 d-none d-lg-block">
                    <div id="clock" class="d-flex align-items-center">
                        <div>
                            <img
                                alt=""
                                src="../../../../public/Links/header/ordina-subito.png"
                            />
                        </div>
                        <div class="d-none d-lg-inline">
                            <p>ORDINA SUBITO E RICEVI LA MERCE</p>
                            <p>
                                <strong> {{ nextDay | formatDate }} </strong>
                            </p>
                        </div>
                    </div>
                </section>
                <section class="col-2 d-flex d-lg-none justify-content-center align-items-center front-top-navbar">
                    <nav class="navbar navbar-expand-lg navbar">
                        <button
                            aria-controls="navbarSupportedContent"
                            :aria-expanded="showNav"
                            aria-label="Toggle navigation"
                            class="navbar-toggler border-0"
                            :class="{'collapsed': showNav}"
                            type="button"
                            @click="showCategoryMenu"
                        >
                            <span class="navbar-toggler-icon">
                                <i class="fas fa-bars"></i>
                            </span>
                        </button>

                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                            :class="{'show': showNav}"
                        >
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                <li
                                    v-for="category in categories"
                                    class="nav-item dropdown mx-1"
                                    :key="`category-${category.id}`"
                                >
                                    <a
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                        class="nav-link dropdown-toggle"
                                        data-toggle="dropdown"
                                        href="#"
                                        :id="`navbarDropdown-${category.id}`"
                                        role="button"
                                    >
                                        {{ category.name }}
                                    </a>

                                    <div
                                        :aria-labelledby="`navbarDropdown-${category.id}`"
                                        class="dropdown-menu dropdown-menu-right"
                                    >
                                        <a
                                            class="dropdown-item text-dark font-weight-bold"
                                            :href="`/category/${category.id}`"
                                        >
                                            📦{{ category.name }}
                                        </a>

                                        <ul v-if="category.subcategories && category.subcategories.length">
                                            <li v-for="(subcategory, sIndex) in category.subcategories"
                                                :key="`sub-${sIndex}`" class="nav-item ml-2">
                                                <a
                                                    class="dropdown-item"
                                                    :href="`/subcategory/${subcategory.id}`"
                                                >
                                                    → {{ subcategory.name }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </section>
                <div class="col-2 col-lg-2">
                    <!-- empty -->
                </div>
                <section class="col-2">
                    <a href="/login">
                        <div id="login" class="d-flex align-items-center">
                            <div>
                                <img
                                    alt=""
                                    src="../../../../public/Links/header/account.png"
                                />
                            </div>
                            <div class="d-none d-lg-inline">
                                <p>
                                    <strong>
                                        {{
                                            checkAuth
                                                ? "DISCONNETTITI"
                                                : "ACCEDI O"
                                        }}
                                    </strong>
                                </p>
                                <p>{{ $store.state.name }}</p>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="col-2">
                    <a href="/cart">
                        <div id="carriage" class="d-flex align-items-center">
                            <div>
                                <img
                                    alt=""
                                    src="../../../../public/Links/header/carrello.png"
                                />
                            </div>
                            <div class="d-none d-lg-inline">
                                <p>
                                    <strong> CARRELLO </strong>
                                </p>
                                <p>
                                    {{ cartTotal }} € /
                                    {{ productCount }}
                                    PRODOTTI
                                </p>
                            </div>
                        </div>
                    </a>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import mixinCart from "../../mixins/mixinCart";
import Categories from "../../mixins/categories";

export default {
    mixins: [mixinCart, Categories],
    data() {
        return {
            showNav: false,
            isLogin: false,
            text: "REGISTRATI",
            nextDay: new Date(new Date().getTime() + 2 * 24 * 60 * 60 * 1000), // set to the day after tomorrow
        };
    },
    filters: {
        formatDate(date) {
            const options = {
                weekday: "long", // spell out the day of the week
                day: "numeric", // show the day of the month as a number
                month: "long", // spell out the month name
            };
            return date.toLocaleDateString("it-IT", options);
        },
    },
    beforeDestroy() {
        window.VBus.stop("update-cart-total", this.setCartTotal);
        window.VBus.stop("hide-category-menu", this.hideCategoryMenu);
    },
    mounted() {
        this.getUserInfo();
        window.VBus.listen("update-cart-total", this.setCartTotal);
        window.VBus.listen("hide-category-menu", this.hideCategoryMenu);
    },
    methods: {
        getUserInfo() {
            axios.get("shop/user", {}).then((response) => {
                if (response.data.is_auth) {
                    this.isLogin = true;

                    this.$store.commit("updateUser", {
                        isAuth: true,
                        name: response.data.name,
                    });

                    this.getCartInfo();
                } else {
                    window.localStorage.removeItem("user");

                    this.$store.commit("updateUser", {
                        isAuth: false,
                        name: "REGISTRATI",
                    });
                }
            });
        },
        getCartInfo() {
            axios.get("shop/carts").then((response) => {
                if (response.data.result === "success") {
                    this.updateCartInfo(this.items);
                }
            });
        },
        setCartTotal({ total, count }) {
            this.cartTotal = total;
            this.productCount = count;
        },
        showCategoryMenu() {
            this.showNav = !this.showNav;
            window.VBus.fire('toggle-background-cover', this.showNav);
        },
        hideCategoryMenu() {
            this.showNav = false;
        }
    },
};
</script>

<style lang="scss" scoped>
.HeaderTop {
    width: 100%;
    height: fit-content;
    background-color: rgb(245, 133, 47);
    color: white;

    section {
        cursor: pointer;
        transition: 1s;

        img {
            height: 25px;
            padding: 0 10px;
            margin: 0.5rem 0;
        }

        p {
            margin: 0;
            font-size: 0.6rem;
        }

        a {
            text-decoration: none;
            color: white;
        }
    }
}
</style>

<!--errors: 1-Inserting lang=scss in the-->
<!--<style>-->

<!--</style>-->
<!--@import './assets/style/variables.scss'; solutions: 1-This error occurs when you-->
<!--try to use SCSS (Sass) in your project but do not have the necessary-->
<!--dependencies installed. The solution is to install Bootstrap, which includes the-->
<!--required dependencies for using SCSS in your project. npm install bootstrap-->
<!--&#45;&#45;save //terminal @import '~bootstrap/scss/bootstrap'; //app.vue-->
<!--<style>-->

<!--</style>-->
