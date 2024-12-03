<script setup>
import router from "@/router";
import { useProductStore } from "@/stores/product";
import { toast } from "@steveyuowo/vue-hot-toast";
import { storeToRefs } from "pinia";

const { product, loading, error } = storeToRefs(useProductStore());
const { createProduct, clearProduct } = useProductStore();

async function submitHandler(e) {
  e.preventDefault();
  const res = await createProduct();

  if (res) {
    toast.error("Failed create");
  } else {
    clearProduct();
    toast.success("Success create");
    router.push({ name: "product.index" });
  }
}
</script>

<template>
  <main class="container mx-auto px-3">
    <div class="flex items-center justify-between my-10">
      <h1 class="text-xl md:text-2xl">Create Product</h1>

      <RouterLink
        :to="{ name: 'product.index' }"
        class="btn btn-sm btn-primary"
      >
        Back
      </RouterLink>
    </div>

    <div class="bg-emerald-50 p-10 rounded-md">
      <form v-on:submit="submitHandler" class="text-base-100">
        <label class="form-control w-full max-w-lg mx-auto my-0">
          <div class="label">
            <span class="label-text text-base-100">Product name?</span>
          </div>
          <input
            type="text"
            name="name"
            v-model="product.name"
            placeholder="Product Name"
            class="input input-bordered w-full max-w-lg text-base-content"
            minLength="3"
            required
          />
          <div class="label">
            <span v-for="msg in error?.name" class="label-text-alt text-error">
              {{ msg }}
            </span>
          </div>
        </label>

        <label class="form-control w-full max-w-lg mx-auto my-0">
          <div class="label">
            <span class="label-text text-base-100">Price?</span>
          </div>
          <input
            type="number"
            name="price"
            v-model="product.price"
            placeholder="Product Price"
            class="input input-bordered w-full max-w-lg text-base-content"
            min="1"
            required
          />
          <div class="label">
            <span v-for="msg in error?.price" class="label-text-alt text-error">
              {{ msg }}
            </span>
          </div>
        </label>

        <label class="form-control w-full max-w-lg mx-auto my-0">
          <div class="label">
            <span class="label-text text-base-100">Stock?</span>
          </div>
          <input
            type="number"
            name="stock"
            v-model="product.stock"
            placeholder="Product stock"
            class="input input-bordered w-full max-w-lg text-base-content"
            min="0"
            required
          />
          <div class="label">
            <span v-for="msg in error?.stock" class="label-text-alt text-error">
              {{ msg }}
            </span>
          </div>
        </label>

        <label class="form-control justify-end w-full max-w-lg mx-auto mt-10">
          <button type="submit" class="btn btn-primary">Save</button>
        </label>
      </form>
    </div>
  </main>
</template>
