import { createStore } from 'vuex';
import cart from './modules/cart';
import user from './modules/user';
import notification from './modules/showNotification';
import isViewCartVisible from '../store/modules/closeCart';

const store = createStore({
   modules: {
      cart,
      user,
      isViewCartVisible,
      notification,
   },
});

export default store;
