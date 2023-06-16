<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
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
                    <div class="content content-full overflow-hidden">
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
                                <input type="text" class="form-control" v-model="form.email" required autofocus placeholder="Enter your email">
                                <label class="form-label" for="login-username">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control"  v-model="form.password" required placeholder="Enter your password">
                                <label class="form-label" for="login-password">Password</label>
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
                    </div>
                </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>

</template>
