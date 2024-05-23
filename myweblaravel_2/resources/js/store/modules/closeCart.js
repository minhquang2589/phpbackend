
import axios from 'axios';

const state = {
   isViewCartVisible: false,
};

const mutations = {
   toggleViewCart(state) {
      state.isViewCartVisible = !state.isViewCartVisible;
   },
   closeViewCart(state) {
      state.isViewCartVisible = false;
   },
};

const actions = {
   toggleViewCart({ commit }) {
      commit('toggleViewCart');
   },
   closeViewCart({ commit }) {
      commit('closeViewCart');
   },
};

const getters = {
   isViewCartVisible: (state) => state.isViewCartVisible,
};

export default {
   state,
   mutations,
   actions,
   getters,
};
