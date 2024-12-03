import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import ProductIndexView from "../views/Product/IndexView.vue";
import ProductCreateView from "../views/Product/CreateView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "index",
      redirect: "/products",
    },
    {
      path: "/products",
      children: [
        {
          path: "",
          name: "product.index",
          component: ProductIndexView,
        },
        {
          path: "create",
          name: "product.create",
          component: ProductCreateView,
        },
      ],
    },
    {
      path: "/home",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
  ],
});

export default router;
