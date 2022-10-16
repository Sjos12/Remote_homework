<template>
    <h1 class="title">This is dashboard</h1>
    <Link class="btn btn-primary" :href="$route('questions.create.index')"
        >Create question</Link
    >
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    layout: LayoutVue,
};
</script>