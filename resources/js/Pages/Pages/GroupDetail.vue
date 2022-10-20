<template>
    <h1 class="title">{{ group.name }}</h1>
    <h2 v-for="member of group.members" :key="member.id">
        {{ member.name }}
    </h2>

    <h1 v-if="group.invite" class="">
        Invite code
        {{ group.invite.invite_code }}
    </h1>
    <Link
        class="btn btn-primary"
        :href="$route('questions.create.index', this.group.id)"
        >Create question</Link
    >
    <button
        v-if="isAdmin && inviteLinkNotGeneratedYet()"
        @click="generateInvite"
        class="btn btn-primary"
    >
        Invite user
    </button>

    <div v-for="question of getQuestions" :key="question.id">
        {{ question.title }}
    </div>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    layout: LayoutVue,
    props: ["group"],
    components: {
        Link,
    },
    computed: {
        getQuestions() {
            if (this.group.questions) return this.group.questions;
            return [];
        },
    },
    methods: {
        isAdmin() {
            this.group.members.forEach((member) => {
                if (member.member_type == 2 || member.member_type == 1) {
                    return true;
                }
            });
            return false;
        },
        inviteLinkNotGeneratedYet() {
            if (this.group.invite) {
                return false;
            }
            return true;
        },
        generateInvite() {
            let url = route("invite.generate", this.group);
            this.$inertia.get(
                url,
                {},
                {
                    preserveState: true,
                }
            );
        },
    },
};
</script>