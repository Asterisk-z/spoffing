<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
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
</script>

<template>
    <Head title="Domains" />

    <AuthenticatedLayout>
        <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Domain List</h3>
            <a class="btn btn-info mr-3">Find Domain</a>
        </div>
        <div class="block-content">
            <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Domain</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
        </div>
        </div>
    </AuthenticatedLayout>
</template>
