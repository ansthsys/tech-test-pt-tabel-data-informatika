<script setup>
import axios from "axios";
import { onBeforeMount, onMounted, ref } from "vue";

const products = ref([]);

onBeforeMount(async () => {
  const res = await axios.get('http://localhost:8000/products');
  console.log(res)
});

onMounted(() => {
  console.log("mounted");
});
</script>

<template>
  <main class="container mx-auto">
    <div class="flex items-center justify-between my-10">
      <h1 class="text-xl md:text-2xl">List Product</h1>

      <RouterLink
        :to="{ name: 'product.create' }"
        class="btn btn-sm btn-primary"
      >
        Add
      </RouterLink>
    </div>

    <div class="bg-emerald-50 p-10 rounded-md">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr class="text-base-100">
              <th></th>
              <th>Name</th>
              <th>Job</th>
              <th>Favorite Color</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover text-base-100 hover:text-base-content">
              <th>1</th>
              <td>Hart Hagerty</td>
              <td>Desktop Support Technician</td>
              <td>Purple</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</template>
