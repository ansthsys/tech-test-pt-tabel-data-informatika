<script setup>
import router from "@/router";
import { useOrderStore } from "@/stores/order";
import { useProductStore } from "@/stores/product";
import { toast } from "@steveyuowo/vue-hot-toast";
import { storeToRefs } from "pinia";

const { products } = storeToRefs(useProductStore());
const { getProducts } = useProductStore();
const { order, loading, error } = storeToRefs(useOrderStore());
const { addItem, deleteItem, createOrder, clearOrder } = useOrderStore();

getProducts();

async function submitHandler(e) {
  e.preventDefault();
  const res = await createOrder();

  if (res) {
    toast.error(error?.error ?? "Failed create");
  } else {
    clearOrder();
    toast.success("Success create");
    router.push({ name: "order.index" });
  }
}
</script>

<template>
  <main class="container mx-auto px-3">
    <div class="flex items-center justify-between my-10">
      <h1 class="text-xl md:text-2xl">Create Order</h1>

      <RouterLink :to="{ name: 'order.index' }" class="btn btn-sm btn-primary">
        Back
      </RouterLink>
    </div>

    <div class="bg-emerald-50 p-10 rounded-md">
      <form v-on:submit="submitHandler" class="text-base-100">
        <label class="form-control w-full max-w-lg mx-auto my-0">
          <div class="label">
            <span class="label-text text-base-100">Customer name</span>
          </div>
          <input
            type="text"
            name="name"
            v-model="order.customer_name"
            placeholder="Customer Name"
            class="input input-bordered w-full max-w-lg text-base-content"
            minLength="3"
            required
          />
          <div class="label">
            <span
              v-for="msg in error?.customer_name"
              class="label-text-alt text-error"
            >
              {{ msg }}
            </span>
          </div>
        </label>

        <label class="form-control w-full max-w-lg mx-auto my-0">
          <div class="label">
            <span class="label-text text-base-100">Order date</span>
          </div>
          <input
            type="date"
            name="name"
            v-model="order.order_date"
            class="input input-bordered w-full max-w-lg text-base-content"
            required
          />
          <div class="label">
            <span
              v-for="msg in error?.customer_name"
              class="label-text-alt text-error"
            >
              {{ msg }}
            </span>
          </div>
        </label>

        <div class="divider divider-neutral w-full max-w-lg mx-auto"></div>

        <div
          class="card card-compact bg-neutral-content w-full max-w-lg mx-auto"
        >
          <div class="card-body items-center text-center">
            <label for="" class="label-text self-start text-neutral mb-3">
              Items
            </label>

            <div
              v-for="(item, id) in order.items"
              :key="id"
              class="join justify-stretch rounded-lg w-full"
            >
              <select
                v-model="item.product_id"
                required
                class="select join-item flex-1 text-neutral-content bg-base-100/[.85] rounded-s-lg"
              >
                <option value="" disabled selected class="text-neutral-content">
                  Choose product
                </option>
                <option
                  v-for="(product, id) in products"
                  :value="product.id"
                  :key="id"
                  class="text-neutral-content"
                >
                  {{ product.name }}
                </option>
              </select>
              <input
                type="number"
                min="1"
                value="1"
                v-model="item.quantity"
                required
                class="input input-md w-full join-item text-neutral-content bg-base-100/[.85] flex-1"
              />
              <button
                type="button"
                class="btn join-item btn-error flex-none"
                v-on:click="deleteItem(id)"
                :disabled="order.items.length <= 1"
              >
                <i class="pi pi-trash text-neutral"></i>
              </button>
            </div>
          </div>
        </div>

        <label class="form-control w-full max-w-lg mx-auto my-5">
          <button
            type="button"
            class="btn btn-full btn-outline border-base-100 text-base-100"
            v-on:click="addItem()"
          >
            <i class="pi pi-plus"></i>
            Add Item
          </button>
        </label>

        <label class="form-control justify-end w-full max-w-lg mx-auto mt-14">
          <button type="submit" class="btn btn-primary">Save</button>
        </label>
      </form>
    </div>
  </main>
</template>
