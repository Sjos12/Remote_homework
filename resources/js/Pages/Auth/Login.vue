<template>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full card flex justify-center">
            <div class="card__content container mx-auto">
                <h1 class="title pb-4">Login</h1>
                <form class="form">
                    <div class="form__row">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            class="form-control input--shadow"
                            v-model="loginForm.email"
                            required
                            autocomplete="email"
                            autofocus
                        />
                        <!-- 
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                    </div>

                    <div class="form__row">
                        <label for="password" class="">Password</label>
                        <input
                            type="password"
                            class="form-control input--shadow"
                            required
                            v-model="loginForm.password"
                            autocomplete="current-password"
                        />
                        <!-- 
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                    </div>

                    <div class="">
                        <input
                            class="w-auto"
                            type="checkbox"
                            v-model="loginForm.remember_me"
                        />

                        <label for="remember"> Remember me </label>
                    </div>
                    <div class="flex">
                        <button
                            type="button"
                            @click="submit"
                            class="btn ml-auto"
                        >
                            Login
                        </button>
                    </div>
                    <!-- 
                    @if (Route::has('password.request'))
                    <div
                        class="
                            password-forget-container
                            password-forget-container--padding
                            flex
                            justify-center
                            col-12
                        "
                    >
                        <a
                            class="btn btn-link"
                            href="{{ route('password.request') }}"
                        >
                            Forgot your password?
                        </a>
                    </div>
                    @endif -->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    data() {
        return {
            loginForm: useForm({
                email: null,
                password: null,
                remember_me: false,
            }),
        };
    },
    methods: {
        submit() {
            console.log("click");
            let url = route("login.post");
            this.loginForm.post(url, {
                // Options...
            });
        },
    },
};
</script>