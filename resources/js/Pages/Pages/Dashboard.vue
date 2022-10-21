<template>
    <div class="flex justify-between mb-10">
        <h1 class="title">Welcome, {{ user.name }}</h1>
        <div class="flex">
            <Link
                class="btn btn-primary my-auto"
                :href="$route('group.create.index')"
                >Create group</Link
            >
            <Link
                class="btn btn-secondary my-auto"
                :href="$route('group.join.index')"
            >
                Join Group
            </Link>
        </div>
    </div>

    <div class="grid gap-y-5">
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
    </div>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: ["groups", "user"],
    components: {
        Link,
    },
    layout: LayoutVue,
    data() {
        return {};
    },
};
</script>