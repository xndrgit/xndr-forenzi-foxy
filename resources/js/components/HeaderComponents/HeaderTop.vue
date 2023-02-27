<template>
    <div class="HeaderTop d-flex align-items-center">
        <div class="container-lg">
            <div class="row justify-content-between">
                <section class="col-3 d-flex align-items-center">
                    <div id="free" class="d-flex align-items-center">
                        <div>
                            <img
                                class="img-fluid"
                                src="../../../../public/Links/header/consegna-gratuita.png"
                                alt=""
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
                                src="../../../../public/Links/header/ordina-subito.png"
                                alt=""
                            />
                        </div>
                        <div class="d-none d-lg-inline">
                            <p>ORDINA SUBITO E RICEVI LA MERCE</p>
                            <p>
                                <strong> DOMENICA 26 MARZO 2023 </strong>
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
                                    src="../../../../public/Links/header/account.png"
                                    alt=""
                                />
                            </div>
                            <div class="d-none d-lg-inline">
                                <p>
                                    <strong>
                                        {{
                                            this.$store.state.isAuth
                                                ? "DISCONNETTITI"
                                                : "ACCEDI O"
                                        }}
                                    </strong>
                                </p>
                                <p>{{ this.$store.state.name }}</p>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="col-2">
                    <a href="/cart">
                        <div id="carriage" class="d-flex align-items-center">
                            <router-link to="/cart">
                                <div>
                                    <img
                                        src="../../../../public/Links/header/carrello.png"
                                        alt=""
                                    />
                                </div>
                            </router-link>
                            <div class="d-none d-lg-inline">
                                <p>
                                    <strong> CARRELLO </strong>
                                </p>
                                <p>
                                    {{ this.$store.state.total }} € /
                                    {{ this.$store.state.productCount }}
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
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            isLogin: false,
            text: "REGISTRATI",
        };
    },
    computed: {
        ...mapGetters({
            checkAuth: "checkAuth",
        }),
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
            axios.get("shop/orders", {}).then((response) => {
                this.$store.commit("updateCart", {
                    productCount: response.data.results.products.length,
                    total: parseFloat(response.data.results.subtotal).toFixed(
                        2
                    ),
                });
            });
        },
    },
    mounted() {
        this.getUserInfo();
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
            font-size: 0.5rem;
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
