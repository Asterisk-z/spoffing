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
    user_id: '',
    old_password: '',
    new_password: '',
    confirm_password: '',
});

function submit(id) {
    if (form.old_password == null || form.new_password == null || form.confirm_password == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    form.user_id = id

    form.post(route('profile.change-password'), {
        onFinish: (response) => {
            Toast.fire({
                icon: 'success',
                title: 'Password Updated Successfully'
            })
        },
        onSuccess: () => { },
    })

}
</script>

<template>
    <Head title=" Update Profile" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded" href="javascript:void(0)">
                <div class="block-header px-5">
                    <a class="btn btn-info mr-3 text-capitalize" :href="route('profile')">Back</a>
                    <h2 class="block-title" style="font-size: 20px; text-transform: uppercase;">Update Password</h2>
                </div>
                <div class="block-content pb-5 px-5">
                    <form  @submit.prevent="submit($page.props.auth.user.id)">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label class="form-label">Old Password </label>
                                        <input type="password" class="form-control form-control-lg"  v-model="form.old_password" placeholder="Enter your Old Password..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control form-control-lg"  v-model="form.new_password" placeholder="Enter your New Password..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control form-control-lg"  v-model="form.confirm_password" placeholder="Enter your Confirm Password..">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-primary btn-primary-custom" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="spinner-border text-dark me-1" v-if="form.processing"></span>
                                <i class="fa fa-check opacity-50 me-1" v-else></i>
                                Update Password
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
