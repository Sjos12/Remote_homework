<template>
    <button
        class="btn btn-lg btn-danger"
        :endpoint="endpoint"
        v-on:click="confirmAndDelete(confirmationMessage)"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: [
        'confirmationMessage',
        'endpoint'
    ],

    mounted() {
        console.log('ButtonConfirmDelete component mounted.')
    },

    methods: {
        confirmAndDelete: async function(confirmationMessage) {
            const confirmed = confirm(confirmationMessage)

            if (!confirmed) {
                return
            }

            const headers = new Headers();
            headers.append(
                'X-CSRF-Token',
                document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            );
            headers.append(
                'Accepts',
                'application/json'
            );
            const request = new Request(
                this.endpoint,
                {
                    method: 'DELETE',
                    headers,
                    mode: 'cors',
                    cache: 'default'
                }
            );

            await fetch(request)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not OK')
                    }
                    return response.json()
                })
                .then(response => {
                    console.log(response)

                    // @todo: Show nice modal with notification and remove the deleted question from DOM instead of forcing reload
                    location.reload();
                })
                .catch(error => {
                    console.error(error)

                    // @todo: show model with error
                    alert('An error occurred')
                });
        }
    }

}
</script>
