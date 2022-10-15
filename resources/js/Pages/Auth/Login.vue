<template>
    <div class="container mx-auto d-flex justify-center items-center h-screen">
        <div
            class="
                max-w-32
                card card--login card--shadow card-body
                d-flex
                justify-content-center
            "
        >
            <div class="card__content">
                <h1 class="title2 pb-4">Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="email"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Email address</label
                            >
                            <input
                                id="email"
                                type="email"
                                class="
                                    form-control
                                    @error('email')
                                    is-invalid
                                    @enderror
                                    input--shadow
                                "
                                name="email"
                                required
                                autocomplete="email"
                                autofocus
                            />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
                            <label
                                for="password"
                                class="col-md-12 col-form-label text-left pl-0"
                                >Password</label
                            >
                            <input
                                id="password"
                                type="password"
                                class="
                                    form-control
                                    @error('password')
                                    is-invalid
                                    @enderror
                                    input--shadow
                                "
                                name="password"
                                required
                                autocomplete="current-password"
                            />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>Error</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="
                            form-group
                            d-flex
                            justify-content-center
                            form-group--padding
                        "
                    >
                        <div class="row">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
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
                                type="submit"
                                class="btn btn-primary btn-lg pl-5 pr-5"
                            >
                                Login
                            </button>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                    <div
                        class="
                            password-forget-container
                            password-forget-container--padding
                            d-flex
                            justify-content-center
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
export default {
    
}
</script>