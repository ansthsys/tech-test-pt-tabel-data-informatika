<script setup>
import { useProductStore } from "@/stores/product";
import { toast } from "@steveyuowo/vue-hot-toast";
import { storeToRefs } from "pinia";

const { products, product, loading } = storeToRefs(useProductStore());
const { getProducts, getProduct, clearProduct, updateProduct, deleteProduct } =
  useProductStore();

getProducts();

async function submitHandler() {
  const modal = document.getElementById("modalEdit");
  const res = await updateProduct();

  if (res) {
    toast.error("Failed update");
  } else {
    toast.success("Success update");
  }

  modal.close();
}

async function deleteHandler(id) {
  const res = await deleteProduct(id);

  if (res) {
    toast.error("Failed delete");
  } else {
    toast.success("Success delete");
  }
}

function modalCloseHandler() {
  clearProduct();
}

function modalOpenHandler(id) {
  const modal = document.getElementById("modalEdit");

  getProduct(+id);
  modal.showModal();
}
</script>

<template>
  <main class="container mx-auto px-3">
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
            <tr class="text-base-100 text-center">
              <th></th>
              <th>Name</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="text-base-100 hover:text-base-content text-center"
              v-if="loading"
            >
              <td colspan="5">Loading</td>
            </tr>

            <tr
              class="text-base-100 hover:text-base-content text-center"
              v-if="products.length === 0"
            >
              <td colspan="5">No data available</td>
            </tr>

            <tr
              class="hover text-base-100 hover:text-base-content"
              v-if="products && !loading"
              v-for="(product, id) in products"
              :key="product.id"
            >
              <th class="text-center">{{ id + 1 }}</th>
              <td class="text-left">{{ product.name }}</td>
              <td class="text-right">{{ product.price }}</td>
              <td class="text-center">{{ product.stock }}</td>
              <td>
                <div class="flex gap-3 items-center justify-center">
                  <button
                    class="btn btn-sm btn-warning"
                    v-on:click="modalOpenHandler(product.id)"
                  >
                    <i class="pi pi-pencil"></i>
                  </button>

                  <button
                    class="btn btn-sm btn-error"
                    v-on:click="deleteHandler(product.id)"
                  >
                    <i class="pi pi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <dialog id="modalEdit" class="modal" v-on:close="modalCloseHandler">
      <div class="modal-box">
        <h3 class="text-lg font-bold">Edit product</h3>

        <div>
          <label class="input input-bordered flex items-center gap-2 my-5">
            Name
            <input
              type="text"
              class="grow"
              name="name"
              v-model="product.name"
              placeholder="Product name"
              minlength="3"
              required
            />
          </label>

          <label class="input input-bordered flex items-center gap-2 my-5">
            Price
            <input
              type="number"
              class="grow"
              name="price"
              v-model="product.price"
              min="1"
              required
            />
          </label>

          <label class="input input-bordered flex items-center gap-2 my-5">
            Stock
            <input
              type="number"
              class="grow"
              name="stock"
              v-model="product.stock"
              min="0"
              required
            />
          </label>
        </div>

        <div class="modal-action">
          <form method="dialog">
            <button class="btn">Close</button>
          </form>

          <button
            type="submit"
            class="btn btn-primary"
            v-on:click="submitHandler()"
          >
            Save
          </button>
        </div>
      </div>
    </dialog>
  </main>
</template>
