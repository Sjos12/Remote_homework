<template>
    <div class="grid">
        <div class="thumbnail__wrapper">
            <img
                class="thumbnail thumbnail--left"
                v-if="illustrationToLeft"
                :src="illustrationToLeft.url"
            />
            <img
                :src="activeIllustration.url"
                v-touch:swipe.right="swipeRight"
                v-touch:swipe.left="swipeLeft"
                @keyup.right.prevent="swipeRight"
                @keyup.left.prevent="swipeLeft"
                alt="Thumbnail of Question"
                class="thumbnail thumbnail--active rounded-md"
            />

            <img
                class="thumbnail thumbnail--right"
                v-if="illustrationToRight"
                :src="illustrationToRight.url"
            />
        </div>

        <div class="flex justify-center items-center gap-2 py-3">
            <span
                v-for="n in illustrations.length"
                :key="n"
                :class="
                    n - 1 == activeIllustrationIndex
                        ? 'bg-mainblue'
                        : 'bg-darkmodecolor-100'
                "
                @click="goTo(n - 1)"
                class="ball"
            >
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["illustrations"],
    data() {
        return {
            activeIllustrationIndex: 0,
        };
    },
    methods: {
        swipeRight() {
            console.log("swipe Right");
            let index =
                this.activeIllustrationIndex - 1 >= 0
                    ? (this.activeIllustrationIndex -= 1)
                    : 0;
            this.activeIllustrationIndex = index;
        },
        swipeLeft() {
            console.log("swipe left");
            let index =
                this.activeIllustrationIndex + 1 < this.illustrations.length
                    ? (this.activeIllustrationIndex += 1)
                    : this.illustrations.length - 1;
            this.activeIllustrationIndex = index;
        },
        goTo(index) {
            this.activeIllustrationIndex = index;
        },
    },
    computed: {
        illustrationToLeft() {
            let index =
                this.activeIllustrationIndex - 1 >= 0
                    ? this.activeIllustrationIndex - 1
                    : 0;
            if (index == this.activeIllustrationIndex) return undefined;
            return this.illustrations[index];
        },
        illustrationToRight() {
            let index =
                this.activeIllustrationIndex + 1 < this.illustrations.length
                    ? this.activeIllustrationIndex + 1
                    : this.illustrations.length;
            if (index == this.activeIllustrationIndex) return undefined;
            return this.illustrations[index];
        },
        activeIllustration() {
            return this.illustrations[this.activeIllustrationIndex];
        },
    },
};
</script>
<style lang="scss" scoped>
.thumbnail {
    width: 100%;
    height: 400px;

    object-fit: cover;
    transition: all 1s ease-in-out;
}

.thumbnail--right {
    position: absolute;
    left: -100%;
}

.thumbnail--left {
    position: absolute;
    right: -100%;
}
.thumbnail__wrapper {
    display: flex;
    height: 100%;
    position: relative;
    overflow-x: hidden;
}

.ball {
    display: flex;
    height: 0.5rem;
    width: 0.5rem;
    border-radius: 1rem;
}
</style>