import axios from 'axios';

const state = {
    notification: null,
};
const mutations = {
    setNotification(state, notification) {
        state.notification = notification;
    },
    clearNotification(state) {
        state.notification = null;
    }
};

const actions = {
    showNotification({ commit }, message) {
        commit('setNotification', message);
        const notification = document.createElement("div");
        notification.classList.add("notificationAddcart");
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.remove();
            commit('clearNotification');
        }, 2100);
    },
};

const getters = {
    notification: (state) => state.notification,
};

export default {
    state,
    mutations,
    actions,
    getters,
};
