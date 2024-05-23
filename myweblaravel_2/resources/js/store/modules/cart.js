
import axios from 'axios';

const state = {
   cart: [],
   cartData: {
      totalDiscountAmount: 0,
      newSubtotal: 0,
      cart: []
   },
   cartQuantity: 0,
};


const mutations = {
   setCart(state, cart) {
      state.cart = cart;
   },
   setCartData(state, cartData) {
      state.cartData = cartData;
   },
   setCartQuantity(state, quantity) {
      state.cartQuantity = quantity;
   },
   incrementCartQuantity(state) {
      state.cartQuantity += 1;
   },
   clearVoucher(state) {
      state.cartData.totalDiscountAmount = 0;
      state.cartData.total = Array.isArray(state.cart)
         ? state.cart.reduce((total, item) => total + item.price * item.quantity, 0)
         : 0;
   },
   setErrorMessage(state, message) {
      state.errorMessage = message;
   },
   setIsVoucherValid(state, isValid) {
      state.isVoucherValid = isValid;
   },

};

const actions = {
   fetchCart({ commit }) {
      axios
         .get('/api/cart')
         .then((response) => {
            if (response.data.success) {
               commit('setCart', response.data.cart);
            } else {
               commit('setCart', []);
            }
         })
         .catch((error) => {
            console.error('Error:', error);
            commit('setCart', []);
         });
   },
   fetchCartData({ commit }) {
      axios
         .get('/api/cart/subtotal-total')
         .then((response) => {
            commit('setCartData', response.data);
         })
         .catch((error) => {
            console.error('Error:', error);
         });
   },
   fetchCartQuantity({ commit }) {
      axios
         .get('/api/cart-quantity')
         .then((response) => {
            commit('setCartQuantity', response.data.cartQuantity);
         })
         .catch((error) => {
            console.error('Error fetching cart quantity:', error);
            commit('setCartData', {
               totalDiscountAmount: 0,
               total: 0,
               cart: []
            });
         });
   },
   async checkVoucherCode({ commit, dispatch }, voucherCode) {
      if (typeof voucherCode !== 'string' || !voucherCode.trim()) {
         commit('clearVoucher');
         return;
      }
      try {
         const response = await axios.post('/api/check-voucher', { code: voucherCode });
         if (response.data.success === true) {
            commit('setCartData', response.data.dataInVoucher);
            commit('setIsVoucherValid', true);
            commit('setErrorMessage', "Voucher applied successfully." + "Discount " + response.data.dataInVoucher.VoucherValue + "%");
         }
         else {
            await dispatch('removeVoucherCode');
            commit('setIsVoucherValid', false);
            commit('setErrorMessage', response.data.error);
         }
      } catch (error) {
         await dispatch('removeVoucherCode');
         commit('setIsVoucherValid', false);
         commit('setErrorMessage', error);
      }
   },

   async removeVoucherCode({ commit }) {
      try {
         const response = await axios.post('/api/remove-voucher');
         if (response.data.success == true) {
            commit('clearVoucher');
            commit('setCart', response.data.cart);
            commit('setCartData', response.data.data);
            commit('setErrorMessage', null);
            commit('setIsVoucherValid', false);
         }
      } catch (error) {
         commit('setErrorMessage', error);
         commit('setIsVoucherValid', false);
      }
   }
};

const getters = {
   cart: (state) => state.cart,
   cartData: (state) => state.cartData,
   cartQuantity: (state) => state.cartQuantity,
   errorMessage: (state) => state.errorMessage,
   isVoucherValid: (state) => state.isVoucherValid,
};

export default {
   state,
   mutations,
   actions,
   getters,
};
