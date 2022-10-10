<template>
    <div class="bg-modal absolute flex justify-center items-center">
        <img
            class="m-auto"
            src="https://via.placeholder.com/800x1000"
            alt=""
            srcset=""
        />
    </div>
</template>
<script>
export default {
    props: {
        tile: Object,
    },
    setup(props) {
        console.log(props);
    },
};
</script>