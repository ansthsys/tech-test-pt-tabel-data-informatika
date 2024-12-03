<script setup>
import { Toaster } from "@steveyuowo/vue-hot-toast";
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <div class="navbar bg-emerald-900/5">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <i class="pi pi-bars"></i>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow gap-3"
        >
          <li>
            <RouterLink :to="{ name: 'product.index' }" activeClass="active">
              Product
            </RouterLink>
          </li>
          <li>
            <RouterLink :to="{ name: 'order.index' }" activeClass="active">
              Order
            </RouterLink>
          </li>
        </ul>
      </div>
      <a class="btn btn-ghost text-xl">TechTest</a>
    </div>
    <div class="navbar-center"></div>
    <div class="navbar-end hidden lg:flex">
      <ul class="menu menu-horizontal px-1 gap-3">
        <li>
          <RouterLink :to="{ name: 'product.index' }" activeClass="active">
            Product
          </RouterLink>
        </li>
        <li>
          <RouterLink :to="{ name: 'order.index' }" activeClass="active">
            Home
          </RouterLink>
        </li>
      </ul>
    </div>
  </div>

  <RouterView />
  <Toaster />
</template>
