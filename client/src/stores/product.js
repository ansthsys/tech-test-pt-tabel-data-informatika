import axios from "axios";
import { defineStore } from "pinia";

export const useProductStore = defineStore("product", {
  state: () => ({
    products: [],
    product: {
      name: null,
      price: null,
      stock: null,
    },
    loading: false,
    error: null,
  }),
  getters: {},
  actions: {
    async createProduct() {
      try {
        this.loading = true;
        await axios.post(`http://localhost:8000/products`, this.product);
        return false;
      } catch (error) {
        this.error = error.response.data;
        return true;
      } finally {
        this.clearProduct();
        this.loading = false;
      }
    },
    async updateProduct() {
      try {
        this.loading = true;

        await axios.put(
          `http://localhost:8000/products/${this.product.id}`,
          this.product
        );

        return false;
      } catch (error) {
        this.error = error;
        return true;
      } finally {
        this.getProducts();
      }
    },
    async deleteProduct(id) {
      try {
        await axios.delete(`http://localhost:8000/products/${+id}`);
        return false;
      } catch (error) {
        this.error = error;
        return true;
      } finally {
        this.getProducts();
      }
    },
    getProducts() {
      try {
        this.loading = true;
        this.products = [];

        axios
          .get("http://localhost:8000/products")
          .then((res) => {
            this.products = res.data.data;
          })
          .then((response) => response?.data?.data);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    getProduct(id) {
      try {
        this.loading = true;
        this.clearProduct();

        this.product = this.products.find((i) => i.id == id);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    clearProduct() {
      this.product = {
        name: null,
        price: null,
        stock: null,
      };
    },
  },
});
