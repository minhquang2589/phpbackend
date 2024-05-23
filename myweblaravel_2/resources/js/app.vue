<template>
    <button @click="toggleSidebar" class="sidebar-toggle z-40">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <transition-group name="fadesiderbar">
        <div v-if="isSidebarOpen && isAdmin" class="sidebar-mobile">
            <AdminSiderbar :toggleSidebar="toggleSidebar" />
        </div>
        <div v-if="isSidebarOpen && !isAdmin" class="sidebar-mobile">
            <Siderbar :toggleSidebar="toggleSidebar" />
        </div>
    </transition-group>

    <router-view></router-view>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
import { ref, provide } from "vue";
import Header from "@/components/Header.vue";
import Siderbar from "@/components/layout/Siderbar.vue";
import ViewCart from "@/components/layout/ViewCart.vue";
import AdminSiderbar from "@/components/admin/AdminSiderbar.vue";

export default {
    name: "App",
    components: {
        Header,
        AdminSiderbar,
        Siderbar,
        ViewCart,
    },
    data() {
        return {
            isSidebarOpen: false,
        };
    },
    computed: {
        ...mapGetters(["isAdmin"]),
        sidebarVisibility() {
            return this.isSidebarOpen ? "block" : "none";
        },
    },
    methods: {
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
        },
    },
    created() {
        this.$store.dispatch("fetchUser");
    },
};
</script>
