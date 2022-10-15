<template>
    <h1 class="title w-full text-center">
        Welcome home! You're
        {{ user ? "Authenticated" : "Not authenticated" }}
    </h1>
</template>
<script>
import LayoutVue from "./Layouts/Layout.vue";

export default {
    layout: LayoutVue,
    props: ["user"],
};
</script>