<script setup>
import { useOrderStore } from "@/stores/order";
import { storeToRefs } from "pinia";

const { orders, order, loading } = storeToRefs(useOrderStore());
const {
  getOrders,
  getOrder,
  clearOrder,
  getTotalItem,
  getTotalPrice,
  sumSubtotal,
} = useOrderStore();

getOrders();

function modalCloseHandler() {
  clearOrder();
}

function modalOpenHandler(id) {
  const modal = document.getElementById("modalEdit");

  getOrder(+id);
  modal.showModal();
}
</script>

<template>
  <main class="container mx-auto px-3">
    <div class="flex items-center justify-between my-10">
      <h1 class="text-xl md:text-2xl">List Order</h1>

      <RouterLink :to="{ name: 'order.create' }" class="btn btn-sm btn-primary">
        Add
      </RouterLink>
    </div>

    <div class="bg-emerald-50 p-10 rounded-md">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr class="text-base-100 text-center">
              <th></th>
              <th>Customer Name</th>
              <th>Order Date</th>
              <th>Total Item</th>
              <th>Total Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="text-base-100 hover:text-base-content text-center"
              v-if="loading"
            >
              <td colspan="6">Loading</td>
            </tr>

            <tr
              class="text-base-100 hover:text-base-content text-center"
              v-if="orders.length === 0"
            >
              <td colspan="6">No data available</td>
            </tr>

            <tr
              class="hover text-base-100 hover:text-base-content"
              v-if="orders && !loading"
              v-for="(order, id) in orders"
              :key="order.id"
            >
              <th class="text-center">{{ id + 1 }}</th>
              <td class="text-left">{{ order.customer_name }}</td>
              <td class="text-left">{{ order.order_date }}</td>
              <td class="text-center">{{ getTotalItem(order.id) }}</td>
              <td class="text-right">{{ getTotalPrice(order.id) }}</td>
              <td>
                <div class="flex gap-3 items-center justify-center">
                  <button
                    class="btn btn-sm btn-info"
                    v-on:click="modalOpenHandler(order.id)"
                  >
                    <i class="pi pi-eye"></i>
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
        <h3 class="text-lg font-bold">Detail order</h3>

        <div>
          <label class="form-control w-full max-w-lg my-0">
            <div class="label">
              <span class="label-text">Customer Name</span>
            </div>
            <input
              type="text"
              placeholder="Type here"
              class="input input-bordered w-full max-w-lg"
              v-model="order.customer_name"
              readonly
            />
          </label>
          <label class="form-control w-full max-w-lg my-0">
            <div class="label">
              <span class="label-text">Order Date</span>
            </div>
            <input
              type="text"
              placeholder="Type here"
              class="input input-bordered w-full max-w-lg"
              v-model="order.order_date"
              readonly
            />
          </label>
          <div class="divider divider-neutral w-full max-w-lg mx-auto"></div>
          <div
            v-for="(item, id) in order.items"
            :key="id"
            class="card card-compact bg-neutral text-neutral-content w-full max-w-lg mb-3"
          >
            <div class="card-body items-center text-center">
              <label class="form-control w-full max-w-lg my-0">
                <div class="label">
                  <span class="label-text">Product Name</span>
                </div>
                <input
                  type="text"
                  placeholder="Type here"
                  class="input input-bordered w-full max-w-lg"
                  :value="item?.product?.name"
                  readonly
                />
              </label>
              <label class="form-control w-full max-w-lg my-0">
                <div class="label">
                  <span class="label-text">Quantity</span>
                </div>
                <input
                  type="text"
                  placeholder="Type here"
                  class="input input-bordered w-full max-w-lg"
                  v-model="item.quantity"
                  readonly
                />
              </label>
              <label class="form-control w-full max-w-lg my-0">
                <div class="label">
                  <span class="label-text">Price</span>
                </div>
                <input
                  type="text"
                  placeholder="Type here"
                  class="input input-bordered w-full max-w-lg"
                  :value="+item.price"
                  readonly
                />
              </label>
              <label class="form-control w-full max-w-lg my-0">
                <div class="label">
                  <span class="label-text">Subtotal</span>
                </div>
                <input
                  type="text"
                  placeholder="Type here"
                  class="input input-bordered w-full max-w-lg"
                  :value="sumSubtotal(id)"
                  readonly
                />
              </label>
            </div>
          </div>
        </div>

        <div class="modal-action">
          <form method="dialog">
            <button class="btn">Close</button>
          </form>
        </div>
      </div>
    </dialog>
  </main>
</template>
