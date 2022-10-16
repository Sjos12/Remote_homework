<template>
    <h1 class="title">This is dashboard</h1>
    <Link class="btn btn-primary" :href="$route('questions.create.index')"
        >Create question</Link
    >
    <Link class="btn btn-primary" :href="$route('group.create.index')"
        >Create group</Link
    >
    <Link class="btn btn-secondary" :href="$route('group.join.index')">
        Join Group
    </Link>

    <Link
        v-for="group of groups"
        :key="group.id"
        :href="$route('group.detail', group)"
    >
        <div class="card">
            <h2 class="">{{ group.name }}</h2>
            <p>{{ group.description }}</p>
        </div>
    </Link>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: ["groups"],
    components: {
        Link,
    },
    layout: LayoutVue,
    data() {
        return {};
    },
};
</script>