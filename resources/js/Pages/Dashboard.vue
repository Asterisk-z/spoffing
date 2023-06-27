<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="block block-rounded bg-gd-dusk">
        <div class="block-content bg-white-5">
            <div class="py-4 text-center">
            <h1 class="h2 fw-bold text-white mb-2">{{ ($page.props.auth.user.role_id == 1) ? "Admin Dashboard" : "User Dashboard" }}</h1>
            </div>
        </div>
        </div>

        <div class="row" v-if="$page.props.auth.user.role_id == 1">
            <!-- Row #4 -->
            <div class="col-md-4" >
                <div class="block block-rounded block-transparent bg-primary">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                    <div class="mb-3">
                        <i class="fa fa-users fa-4x text-primary-lighter"></i>
                    </div>
                    <div class="fs-4 fw-semibold text-white">Total User</div>
                    <div class="text-white-75">All registered user</div>
                    <div class="pt-3">
                        <a class="btn btn-alt-primary" href="javascript:void(0)">
                        <i class="fa fa-users opacity-50 me-1"></i> View Users
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block block-rounded block-transparent bg-info">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                    <div class="mb-3">
                        <i class="fa fa-envelope-open fa-4x text-info-light"></i>
                    </div>
                    <div class="fs-4 fw-semibold text-white">New Domain</div>
                    <div class="text-white-75">Total domain From last Search</div>
                    <div class="pt-3">
                        <a class="btn btn-alt-info" href="javascript:void(0)">
                        <i class="fa fa-envelope-open opacity-50 me-1"></i> View Domain
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block block-rounded block-transparent bg-success">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                    <div class="mb-3">
                        <i class="fa fa-check fa-4x text-success-light"></i>
                    </div>
                    <div class="fs-4 fw-semibold text-white">Total Domain</div>
                    <div class=" text-white-75">All Domain</div>
                    <div class="pt-3">
                        <a class="btn btn-alt-success" href="javascript:void(0)">
                        <i class="fa fa-arrow-up opacity-50 me-1"></i> List Domain
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- END Row #4 -->
        </div>


    </AuthenticatedLayout>
</template>
