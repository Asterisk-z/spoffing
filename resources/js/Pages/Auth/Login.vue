<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 7000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

const $props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    token: {
        type: String,
    },
    user: {
        type: Object,
    },
});

const form = useForm({
    email:  ($props.user) ? $props.user.email : '',
    password: ($props.user) ? $props.user.password : '',
    otp: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const submitToken = () => {
    form.post(route('login', { "user_token":$props.token }), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
        <Head title="Log in" />

        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-body-dark">
                <div class="row mx-0 justify-content-center">
                    <div class="hero-static col-lg-6 col-xl-4">

                        <div class="content content-full overflow-hidden" v-if="!$props.token">
                            <!-- Header -->
                            <div class="py-4 text-center">
                                <h1 class="h3 fw-bold mt-4 mb-2">Login to your account</h1>
                            </div>
                            <!-- END Header -->

                            <form class=""   @submit.prevent="submit">
                            <div class="block block-themed block-rounded block-fx-shadow">
                                <div class="block-header bg-gd-dusk">
                                </div>
                                <div class="block-content">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" :class="{'is-invalid' : form.errors.email }" v-model="form.email" required autofocus placeholder="Enter your email">
                                    <label class="form-label" for="login-username">Email</label>
                                    <div  v-if="form.errors.email" class="invalid-feedback animated fadeIn">{{ form.errors.email }}</div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" :class="{ 'is-invalid': form.errors.password }"  v-model="form.password" required placeholder="Enter your password">
                                    <label class="form-label" for="login-password">Password</label>
                                    <div  v-if="form.errors.password" class="invalid-feedback animated fadeIn">{{ form.errors.password }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 d-sm-flex align-items-center push">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  v-model="form.remember">
                                        <label class="form-check-label" for="login-remember-me">Remember Me</label>
                                    </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-end push">
                                        <button class="btn btn-lg btn-alt-primary fw-medium"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                                </div>
                                <div class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                                <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :href="route('register')">
                                    <i class="fa fa-plus opacity-50 me-1"></i> Create Account
                                </a>
                                <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :href="route('password.request')">
                                    Forgot Password
                                </a>
                                </div>
                            </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>

                        <div class="content content-full overflow-hidden" v-else>
                            <!-- Header -->
                            <div class="py-4 text-center">
                                <h1 class="h3 fw-bold mt-4 mb-2">OTP Token</h1>
                            </div>
                            <!-- END Header -->

                            <form class=""  @submit.prevent="submitToken">
                                <div class="block block-themed block-rounded block-fx-shadow">
                                    <div class="block-header bg-gd-dusk">
                                    </div>
                                    <div class="block-content">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" :class="{'is-invalid' : form.errors.otp }" v-model="form.otp" required autofocus placeholder="Enter your otp">
                                        <label class="form-label" for="login-username">Otp</label>
                                        <div  v-if="form.errors.otp" class="invalid-feedback animated fadeIn">{{ form.errors.otp }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-sm-end push">
                                            <button class="btn btn-lg btn-alt-primary fw-medium"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Verify
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                                    <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :href="route('register')">
                                        <i class="fa fa-plus opacity-50 me-1"></i> Create Account
                                    </a>
                                    <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :href="route('password.request')">
                                        Forgot Password
                                    </a>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>

                    </div>
                </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>

</template>
