<template>
    <div class="grid h-screen">
        <div class="h-full w-full flex flex-col gap-y-3 my-10 mx-auto">
            <slot></slot>
        </div>
        <nav
            class="
                bottom-0
                left-0
                right-0
                h-16
                fixed
                z-50
                shadow-lg
                py-2
                bg-darkmodecolor-500
                flex
            "
        >
            <div class="container mx-auto flex justify-between w-full">
                <ul class="flex w-full justify-between gap-5">
                    <li>
                        <Link>
                            <i class="fa fa-users fa-lg"></i>
                        </Link>
                    </li>
                    <li>
                        <Link :href="$route('dashboard')">
                            <i class="fa fa-home fa-lg"></i>
                        </Link>
                    </li>
                    <li>
                        <Link :href="$route('questions.create.index')">
                            <i class="fa fa-plus fa-lg"></i>
                        </Link>
                    </li>
                    <li>
                        <button v-if="user" @click="logout">
                            <i class="fa fa-sign-out fa-lg"></i>
                        </button>
                    </li>
                    <li>
                        <Link href="/login" method="get" v-if="!user">
                            <i class="fa fa-sign-in fa-lg"></i>
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
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