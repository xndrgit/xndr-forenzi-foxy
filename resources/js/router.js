import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter);

import HomePage from "./pages/HomePage";
import PersonalizePage from "./pages/PersonalizePage";
import CartPage from "./pages/CartPage";
import CheckoutPage from "./pages/CheckoutPage";
import ProductPage from "./pages/ProductPage";
import CategoryPage from "./pages/CategoryPage";
import ConfirmPage from "./pages/ConfirmPage";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: HomePage,
        },
        {
            path: "/personalize",
            name: "personalize",
            component: PersonalizePage,
        },
        {
            path: "/cart",
            name: "cart",
            component: CartPage,
        },
        {
            path: "/product/:id",
            name: "product",
            component: ProductPage,
        },
        {
            path: "/category/:id",
            name: "category",
            component: CategoryPage,
        },
        {
            path: "/checkout",
            name: "checkout",
            component: CheckoutPage,
        },
        {
            path: "/confirm",
            name: "confirm",
            component: ConfirmPage,
        },
    ],
});
export default router;
