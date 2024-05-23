<template>
    <div class="flex items-center justify-between bg-gray-600">
        <div>
            <span v-if="isAdmin" class="ml-3 text-white text-sm"> Admin </span>
        </div>
        <div class="text-white text-sm">
            <div class="flex">
                <router-link to="/Dashboard">
                    <a class="hover:underline">Dashboard</a>
                </router-link>
            </div>
        </div>
        <div class="text-white mt-1 text-sm mr-3">
            <span class="hover:underline">
                <a href="#" @click="logout">Logout</a>
            </span>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "AdminHeader",
    props: {
        isAdmin: {
            type: Boolean,
            required: true,
        },
    },
    methods: {
        logout() {
            axios
                .post("/api/logout")
                .then((response) => {
                    if (response.data.success) {
                        this.$router.push({ name: "Login" });
                        window.location.reload();
                    } else {
                        console.error("Failed to log out");
                    }
                })
                .catch((error) => {
                    console.error("An error occurred during logout:", error);
                });
        },
    },
};
</script>
