import VueRouter from "vue-router";
import Vue from "vue";
import HomePage from "./pages/HomePage";
import PersonalizePage from "./pages/PersonalizePage";
import CartPage from "./pages/CartPage";
import CheckoutPage from "./pages/CheckoutPage";
import ProductPage from "./pages/ProductPage";
import CategoryPage from "./pages/CategoryPage";
import ConfirmPage from "./pages/ConfirmPage";
import CongratulationPage from "./pages/CongratulationPage";
import SubcategoryPage from "./pages/SubcategoryPage";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "home",
      component: HomePage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: "/personalize",
      name: "personalize",
      component: PersonalizePage,
      meta: {
        requiresAuth: false
      }
    },
    {
      path: "/cart",
      name: "cart",
      component: CartPage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: "/product/:id",
      name: "product",
      component: ProductPage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: "/category/:id",
      name: "category",
      component: CategoryPage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: "/subcategory/:id",
      name: "subcategory",
      component: SubcategoryPage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: "/checkout",
      name: "checkout",
      component: CheckoutPage,
      meta: {
        requiresAuth: true
      },
    },
    {
      path: "/confirm/:id",
      name: "confirm",
      component: ConfirmPage,
      meta: {
        requiresAuth: true
      },
    },
    {
      path: "/congratulation",
      name: "congratulation",
      component: CongratulationPage,
      meta: {
        requiresAuth: false
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (!window.localStorage.getItem('user')) {
      console.log('hey');
      window.location.href = '/login';
    }
  }

  next();
});

export default router;
