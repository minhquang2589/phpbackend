<template>
  <div class="filter_mobile">
    <div class="overflow-hidden z-50 h-screen rounded border bg-white border-gray-400">
      <div class="flex items-center justify-between gap-2 bg-white p-4 text-gray-900 transition">
        <span class="text-sm font-medium">Filter</span>
        <button @click="closeFilter" class="togger-hidden">X</button>
      </div>
      <div class="border-t border-gray-300 bg-white">
        <ul class="space-y-1 border-gray-200 p-4">
          <li>
            <div class="relative">
              <input
                type="text"
                v-model="searchKey"
                placeholder="Search for ..."
                class="w-full rounded-md border border-gray-500 py-1 pe-10 sm:text-sm"
                @input="updateFilters"
              />
              <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                <button
                  id="searchButton"
                  type="button"
                  class="text-gray-600 hover:text-gray-700"
                  @click="updateFilters"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-4 w-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                    />
                  </svg>
                </button>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div class="border-t border-gray-200 p-4">
        <div>
          <label for="priceFrom" class="flex items-center gap-2">
            <input
              type="number"
              v-model="priceFrom"
              id="priceFrom"
              placeholder="From"
              class="w-full border py-0.5 rounded-md border-gray-200 shadow-sm sm:text-sm"
              @input="updateFilters"
            />
            <span class="text-sm text-gray-600">đ</span>
          </label>
          <label for="priceTo" class="flex mt-2 items-center gap-2">
            <input
              type="number"
              id="priceTo"
              v-model="priceTo"
              placeholder="To"
              class="w-full rounded-md py-0.5 border border-gray-200 shadow-sm sm:text-sm"
              @input="updateFilters"
            />
            <span class="text-sm text-gray-600">đ</span>
          </label>
        </div>
      </div>
      <ul class="space-y-1 border-t border-gray-200 p-4">
        <li>
          <label for="filternew" class="inline-flex items-center gap-2">
            <input
              type="checkbox"
              v-model="filternew"
              class="size-4 rounded border-gray-300"
              @change="updateFilters"
            />
            <div class="flex">
              <span class="text-sm mr-1 font-medium text-gray-700">New</span>
              <span class="text-sm mr-1 font-medium text-gray-700">({{ newCount }})</span>
            </div>
          </label>
        </li>
        <li>
          <label for="filterDiscount" class="inline-flex items-center gap-2">
            <input
              type="checkbox"
              v-model="filterDiscount"
              class="size-4 rounded border-gray-300"
              @change="updateFilters"
            />
            <div class="flex">
              <span class="text-sm mr-1 font-medium text-gray-700">Discount</span>
              <span class="text-sm mr-1 font-medium text-gray-700">({{ discountCount }})</span>
            </div>
          </label>
        </li>
        <li>
          <label for="filterinstock" class="inline-flex items-center gap-2">
            <input
              type="checkbox"
              v-model="filterinstock"
              class="size-4 rounded border-gray-300"
              @change="updateFilters"
            />
            <div class="flex">
              <span class="text-sm mr-1 font-medium text-gray-700">In Stock</span>
              <span class="text-sm mr-1 font-medium text-gray-700">({{ inStockCount }})</span>
            </div>
          </label>
        </li>
        <li>
          <label for="filteroutofstock" class="inline-flex items-center gap-2">
            <input
              type="checkbox"
              v-model="filteroutofstock"
              class="size-4 rounded border-gray-300"
              @change="updateFilters"
            />
            <div class="flex">
              <span class="text-sm mr-1 font-medium text-gray-700">Out of Stock</span>
              <span class="text-sm mr-1 font-medium text-gray-700">({{ OutOfStockCount }})</span>
            </div>
          </label>
        </li>
      </ul>
      <ul class="space-y-1 border-t border-gray-200 p-2">
        <li>
          <div class="flex py-1 justify-center">
            <button
              id="resetFilters"
              type="button"
              class="text-sm text-gray-900 hover:underline"
              @click="resetFilters"
            >
              Reset
            </button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "FilterMobile",
  props: ["toggleFilter"],
  data() {
    return {
      searchKey: "",
      priceFrom: null,
      priceTo: null,
      filternew: false,
      filterDiscount: false,
      filterinstock: false,
      filteroutofstock: false,
      discountCount: 0,
      newCount: 0,
      inStockCount: 0,
      OutOfStockCount: 0,
    };
  },
  mounted() {
    axios
      .get("/api/filter/content")
      .then((response) => {
        this.newCount = response.data.newCount;
        this.discountCount = response.data.discountCount;
        this.inStockCount = response.data.instockCount;
        this.OutOfStockCount = response.data.outstockCount;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  },
  methods: {
    closeFilter() {
      this.toggleFilter();
    },
    updateFilters() {
      const filters = {
        searchKey: this.searchKey,
        priceFrom: this.priceFrom,
        priceTo: this.priceTo,
        filternew: this.filternew,
        filterDiscount: this.filterDiscount,
        instock: this.filterinstock,
        outofstock: this.filteroutofstock,
      };
      this.$emit("updateFilters", filters);
    },
    resetFilters() {
      this.searchKey = "";
      this.priceFrom = null;
      this.priceTo = null;
      this.filternew = false;
      this.filterDiscount = false;
      this.filterinstock = false;
      this.filteroutofstock = false;
      this.updateFilters();
    },
  },
};
</script>

<style scoped>
@media only screen and (max-width: 768px) {
  .filter-button {
    display: block;
  }
  .filter_mobile {
    display: block;
  }
}
.togger-hidden {
  border: 1px solid rgba(200, 200, 200, 1);
  cursor: pointer;
  padding: 0px 5px 2px 5px;
  border-radius: 4px;
  color: black;
}
.filter_mobile{
  z-index:9999;
}
</style>
