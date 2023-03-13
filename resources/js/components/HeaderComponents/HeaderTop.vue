<template>
    <div class="HeaderTop d-flex align-items-center">
        <div class="container-lg">
            <div class="row justify-content-between">
                <section class="col-3 d-flex align-items-center">
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
                <section class="col-3">
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
                <div class="col-2">
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
                                        {{ checkAuth ? "DISCONNETTITI" : "ACCEDI O" }}
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

export default {
    mixins: [mixinCart],
    data() {
        return {
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
    },
    mounted() {
        this.getUserInfo();
        window.VBus.listen("update-cart-total", this.setCartTotal);
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
                }
                else {
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
        setCartTotal({total, count}) {
            this.cartTotal = total;
            this.productCount = count;
        },
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
