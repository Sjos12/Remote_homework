<template>
    <div>
        <nav class="shadow-lg py-2 bg-darkmodecolor-300 flex">
            <div class="container mx-auto flex justify-between w-full">
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
            </div>
        </nav>
        <div class="container my-10 mx-auto">
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

<style lang="scss" scoped>
.navbar {
}
</style>