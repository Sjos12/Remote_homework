<template>
    <div class="container mx-auto flex justify-center items-center h-screen">
        <div
            class="
                max-w-32
                card card--login card--shadow card-body
                flex
                justify-center
            "
        >
            <div class="card__content">
                <h1 class="title2 pb-4">Register</h1>

                <span
                    class="invalid-feedback"
                    v-for="error of registerForm.errors"
                    :key="error"
                    role="alert"
                >
                    <strong>{{ error }}</strong>
                </span>

                <form>
                    <div class="form-group row flex justify-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="email"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Name</label
                            >
                            <input
                                type="text"
                                class="form-control input--shadow"
                                v-model="registerForm.name"
                                autocomplete="name"
                                required
                                autofocus
                            />

                            <!-- @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                        </div>
                    </div>

                    <div class="form-group row flex justify-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="email"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Email address</label
                            >
                            <input
                                type="email"
                                v-model="registerForm.email"
                                class="form-control input--shadow"
                                required
                                autocomplete="email"
                                autofocus
                            />

                            <!-- @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                        </div>
                    </div>

                    <div class="form-group row flex justify-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="password"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Password</label
                            >
                            <input
                                type="password"
                                v-model="registerForm.password"
                                class="form-control input--shadow"
                                required
                                autocomplete="current-password"
                            />

                            <!-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                        </div>
                    </div>
                    <div class="form-group row flex justify-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="password"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Repeat Password</label
                            >
                            <input
                                type="password"
                                v-model="registerForm.password_confirmation"
                                class="form-control input--shadow"
                                required
                                autocomplete="new-password"
                            />

                            <!-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror -->
                        </div>
                    </div>

                    <div
                        class="
                            form-group
                            flex
                            justify-center
                            form-group--padding
                        "
                    >
                        <div class="row">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="registerForm.remember_me"
                                />

                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0 pt-3">
                        <div class="mx-auto">
                            <button
                                type="button"
                                @click="submit"
                                class="btn btn-primary btn-lg pl-5 pr-5"
                            >
                                Register
                            </button>
                        </div>
                    </div>

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
                    @endif
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
export default {
    data() {
        return {
            registerForm: useForm({
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                remember_me: false,
            }),
        };
    },
    methods: {
        throwError() {
            // Temporary...
            console.error("Something went wrong");
        },
        submit() {
            let url = route("register.create");
            console.log(url, this.registerForm);
            if (
                this.registerForm.password_confirmation !=
                this.registerForm.password
            ) {
                this.throwErrror();
            }
            this.registerForm.post(url, {
                preserveState: false,
                preserveScroll: true,
            });
        },
    },
};
</script>