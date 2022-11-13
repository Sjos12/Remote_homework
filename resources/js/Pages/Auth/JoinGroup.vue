<template>
    <div class="grid h-screen justify-center items-center">
        <div class="card grid gap-y-10">
            <h1 class="title">Join a group using an invite code.</h1>
            <div class="flex">
                <input
                    placeholder="Enter an invite code..."
                    type="text"
                    v-model="joinGroupForm.groupCode"
                />
                <button class="btn" @click="submitJoinGroupForm">Join</button>
            </div>
            <div class="flex justify-center">
                <button @click="skip">No thanks!</button>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    data() {
        return {
            joinGroupForm: useForm({
                groupCode: "",
            }),
        };
    },
    methods: {
        submitJoinGroupForm() {
            let url = route("group.join");
            this.joinGroupForm.post(url);
        },
        skip() {
            this.$inertia.visit(route("dashboard"));
        },
    },
};
</script>