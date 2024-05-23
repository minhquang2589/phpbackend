
import axios from 'axios';

const state = {
   user: {
      isAdmin: false,
      isAuthenticated: false,
   },
};

const mutations = {
   setUser(state, user) {
      state.user = {
         name: user.name,
         isAdmin: user.role === 'admin',
         isAuthenticated: true,
      };
   },
};

const actions = {
   fetchUser({ commit }) {
      axios
         .get('/api/user')
         .then((response) => {
            commit('setUser', response.data);
         })
         .catch(() => {
            commit('setUser', { isAdmin: false, isAuthenticated: false });
         });
   },
};

const getters = {
   isAdmin: (state) => state.user.isAdmin,
   isAuthenticated: (state) => state.user.isAuthenticated,
};

export default {
   state,
   mutations,
   actions,
   getters,
};
