<template>
    <div class="flex h-screen items-center justify-center bg-white">
        <div class="text-center">
            <h1 class="text-10xl font-black text-gray-300">404</h1>
            <p class="text-9xl font-bold text-gray-900">Oh-no!</p>
            <p class="mt-4 text-gray-500">We can't find that page.</p>
            <router-link to="/">
                <a
                    href="#"
                    class="mt-6 inline-block rounded bg-black px-5 py-3 text-sm font-medium text-white focus:outline-none focus:ring"
                >
                    Go Back Home
                </a>
            </router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: "Error",
};
</script>
