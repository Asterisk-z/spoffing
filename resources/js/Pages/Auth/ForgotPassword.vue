<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />
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
                                    <h1 class="h3 fw-bold mt-4 mb-2">Forgot your password</h1>
                                </div>
                                <!-- END Header -->
                                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                    {{ status }}
                                </div>


                                <form class="" @submit.prevent="submit">
                                    <div class="block block-themed block-rounded block-fx-shadow">
                                        <div class="block-header bg-gd-dusk">
                                        </div>
                                        <div class="block-content">
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.email }" v-model="form.email" required
                                                    autofocus placeholder="Enter your email">
                                                <label class="form-label">Email</label>
                                                <div v-if="form.errors.email" class="invalid-feedback animated fadeIn">{{
                                                    form.errors.email }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-sm-end push">
                                                    <button class="btn btn-lg btn-alt-primary fw-medium"
                                                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                        Email Password Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                                            <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block"
                                                :href="route('register')">
                                                <i class="fa fa-plus opacity-50 me-1"></i> Register
                                            </a>
                                            <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block"
                                                :href="route('login')">
                                                Login
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

