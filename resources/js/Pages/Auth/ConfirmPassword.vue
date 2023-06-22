<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Confirm Password" />
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
                                    <h1 class="h3 fw-bold mt-4 mb-2">Confirm Password</h1>
                                    <p>
                                        This is a secure area of the application. Please confirm your password before continuing.
                                    </p>
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
                                                <input type="password" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.password }" v-model="form.password" required
                                                    autofocus placeholder="Enter your new password">
                                                <label class="form-label">Password</label>
                                                <div v-if="form.errors.password" class="invalid-feedback animated fadeIn">{{
                                                    form.errors.password }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-sm-end push">
                                                    <button class="btn btn-lg btn-alt-primary fw-medium"
                                                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                        Confirm
                                                    </button>
                                                </div>
                                            </div>
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
