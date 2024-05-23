<template>
<Layout>
 <div class="grid grid-cols-1 pb-16 gap-1 lg:grid-cols-6">
        <div class="h-fit standing">
            <Siderbar />
        </div>
        <div class="h-full lg:col-span-5">
            content
        </div>
    </div>
</Layout>
</template>
<script>
import Siderbar from "@/components/Siderbar.vue";
import Layout from "@/components/Layout.vue";

export default {
    name: "Dashboard",
    components: {
        Siderbar,
        Layout,
    }
};
</script>
