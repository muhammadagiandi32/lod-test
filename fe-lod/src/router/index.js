import {
  createRouter,
  createMemoryHistory,
  createWebHistory,
} from "vue-router";
import auth from "../middleware/auth";
import axios from "axios";
const routes = [
  {
    path: "/",
    name: "/",
    component: () => import("../view/IndexView.vue"),
  },
  {
    path: "/login",
    name: "/login",
    component: () => import("../view/LoginView.vue"),
  },
  {
    path: "/detail/:slug",
    name: "detail",
    component: () => import("../view/DetailView.vue"),
    //    meta: {title: "detail"}
  },
  {
    path: "/edit/:slug",
    name: "edit",
    component: () => import("../view/EditView.vue"),
    //    meta: {title: "detail"}
  },
  {
    path: "/delete/:slug",
    name: "delete",
    beforeEnter: (to, from, next) => {
      // localStorage.removeItem("X-AUTH-TOKEN");
      console.log(to.params.slug);
      axios
        .post(`api/article/delete/` + to.params.slug)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          // error.response.status Check status code
          console.log(error);
        });
      next("/");
    },
  },
  {
    path: "/logout",
    name: "/logout",
    beforeEnter: (to, from, next) => {
      localStorage.removeItem("X-AUTH-TOKEN");
      next("/login");
    },
  },
  {
    path: "/create",
    name: "/create",
    component: () => import("../view/CreateView.vue"),
    beforeEnter: (to, from, next) => {
      // reject the navigation
      if (localStorage.getItem("X-AUTH-TOKEN") == null) {
        next({
          path: "/login",
          params: { nextUrl: to.fullPath },
        });
      } else {
        try {
        } catch (err) {
          console.log("token is null: ", err);
        }
        next(); // Add this ✅
      }
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
export default router;
