<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    provinces: {
        type: Object,
    },
    timezones: {
        type: Object,
    },
    auth_user: {
        type: Object,
    },
});


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

const form = useForm({
    user_id: props.auth_user.id,
    first_name: props.auth_user.first_name,
    last_name: props.auth_user.last_name,
    address: props.auth_user.address,
    phone_number: props.auth_user.phone_number,
    city: props.auth_user.city,
    province: props.auth_user.province,
    timezone: props.auth_user.timezone,
});

function submit() {
    if (form.first_name == null || form.last_name == null  || form.address == null || form.phone_number == null || form.city == null || form.province == null || form.timezone == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    router.post('/profile-update', form)

    Toast.fire({
        icon: 'success',
        title: 'Profile Created Successfully'
    })
}
</script>

<template>
    <Head title=" Update Profile" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded" href="javascript:void(0)">
                <div class="block-header px-5">
                    <h2 class="block-title">Update Profile</h2>
                </div>
                <div class="block-content pb-5 px-5">
                    <form  @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label class="form-label">Firstname </label>
                                        <input type="text" class="form-control form-control-lg"  v-model="form.first_name" placeholder="Enter your firstname..">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Lastname</label>
                                        <input type="text" class="form-control form-control-lg"  v-model="form.last_name" placeholder="Enter your lastname..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control form-control-lg"  v-model="form.address" placeholder="Enter your address..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control form-control-lg"  v-model="form.city" placeholder="Enter your city..">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control form-control-lg"  v-model="form.phone_number" placeholder="Enter your phone number..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" v-model="form.province">
                                            <option :value="null">Select A Province</option>
                                            <option v-for="province in provinces" v-bind:key="province" :value="province">{{ province }}</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">TImezone</label>
                                        <select class="form-select" v-model="form.timezone">
                                            <option :value="null">Select A timezone</option>
                                            <option v-for="timezone in timezones" v-bind:key="timezone" :value="timezone.location">{{ timezone.time }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-primary btn-primary-custom" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="spinner-border text-dark me-1" v-if="form.processing"></span>
                                <i class="fa fa-check opacity-50 me-1" v-else></i>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="false">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
