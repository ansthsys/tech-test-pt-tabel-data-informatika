import axios from "axios";
import { defineStore } from "pinia";

export const useOrderStore = defineStore("order", {
  state: () => ({
    orders: [],
    order: {
      customer_name: null,
      order_date: null,
      items: [
        {
          product_id: null,
          quantity: null,
        },
      ],
    },
    loading: false,
    error: null,
  }),
  getters: {},
  actions: {
    async createOrder() {
      try {
        this.loading = true;
        await axios.post(`http://localhost:8000/orders`, this.order);
        return false;
      } catch (error) {
        this.error = error.response.data;
        return true;
      } finally {
        this.clearOrder();
        this.loading = false;
      }
    },
    getOrders() {
      try {
        this.loading = true;
        this.orders = [];

        axios
          .get("http://localhost:8000/orders")
          .then((res) => {
            this.orders = res.data.data;
          })
          .then((response) => response?.data?.data);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    getOrder(id) {
      try {
        this.loading = true;
        this.clearOrder();
        this.order = this.orders.find((i) => i.id == id);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    clearOrder() {
      this.order = {
        customer_name: null,
        order_date: null,
        items: [
          {
            product_name: null,
            quantity: null,
          },
        ],
      };
    },
    clearItems() {
      this.order.items = [
        {
          product_id: null,
          quantity: null,
        },
      ];
    },
    addItem() {
      this.order.items.push({
        product_id: null,
        quantity: null,
      });
    },
    deleteItem(index) {
      if (this.order.items.length <= 1) {
        return;
      }

      this.order.items.splice(index, 1);
    },
    getTotalItem(id) {
      return this.orders
        .find((i) => i.id == id)
        .items.reduce((acc, item) => +acc + +item.quantity, 0);
    },
    getTotalPrice(id) {
      return this.orders
        .find((i) => i.id === id)
        .items.reduce((acc, item) => +acc + +item.price, 0);
    },
    sumSubtotal(index) {
      const item = this.order.items[index];
      return +item["quantity"] * +item["price"];
    },
  },
});
