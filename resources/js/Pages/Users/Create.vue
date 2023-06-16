<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
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

defineProps({
    provinces: {
        type: Object,
    },
    timezones: {
        type: Object,
    },
    test: {
        type: String,
    },
});

let button = "Create User";

const form = useForm({
    first_name: null,
    last_name: null,
    email_address: null,
    address: null,
    phone_number: null,
    city: null,
    province: null,
    timezone: null,
});

function submit() {
    if (form.first_name == null || form.last_name == null || form.email_address == null || form.address == null || form.phone_number == null || form.city == null || form.province == null || form.timezone == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    button = "Creating User"
    router.post('/user-create', form)

    Toast.fire({
        icon: 'success',
        title: 'User Created Successfully'
    })
}

</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Create User </h3>
                <a :href="route('users.list.pending')" class="btn btn-info mr-3">Pending User</a>
                <a :href="route('users.list')" class="btn btn-outline-info mr-3">Users</a>
            </div>

            <div class="block-content">
                <form  @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label">Firstname</label>
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
                                    <label class="form-label">Email Address</label>
                                    <input type="text" class="form-control form-control-lg"  v-model="form.email_address" placeholder="Enter your email address..">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg"  v-model="form.phone_number" placeholder="Enter your phone number..">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control form-control-lg"  v-model="form.city" placeholder="Enter your city..">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" v-model="form.province">
                                        <option :value="null">Select A Province</option>
                                        <option v-for="province in provinces" v-bind:key="province" :value="province">{{ province }}</option>
                                    </select>
                                </div>
                                <div class="col-4">
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
                        <button class="btn btn-primary btn-primary-custom" type="submit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            <i class="fa fa-check opacity-50 me-1"></i> {{ button }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
