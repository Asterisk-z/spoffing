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
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header px-5">
                    <h2 class="block-title">Profile</h2>
                    <a class="btn btn-info mr-3 text-capitalize" :href="route('profile.edit')">Update Profile</a>
                </div>
                <div class="block-content pb-5 px-5">

                      <table class="table table-borderless table-striped">
                        <thead>
                          <tr>
                            <th style="width: 200px;"></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><a class="fw-semibold">Name</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.name }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">Email</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.email }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">Address</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.address }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">Phone Number</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.phone_number }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">City</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.city }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">Province</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.province }}</span> </td>
                          </tr>
                          <tr>
                            <td><a class="fw-semibold">Timezone</a></td>
                            <td><span class="fw-bold">{{ $page.props.auth.user.timezone }}</span> </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
