<template>
    <div>
        <nav class="shadow-lg py-4 bg-gray-500 flex">
            <ul class="flex">
                <li></li>
            </ul>
            <Link
                href="/login"
                method="get"
                v-if="!user"
                class="btn btn-primary"
            >
                Log In
            </Link>
            <button v-if="user" @click="logout" class="btn btn-primary">
                Logout
            </button>
        </nav>
        <div class="container mx-auto">
            <slot></slot>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: ["user"],
    components: {
        Link,
    },
    methods: {
        logout() {
            this.$inertia.post("/logout");
        },
    },
};
</script>