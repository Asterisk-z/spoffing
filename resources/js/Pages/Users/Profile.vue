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

const props = defineProps({
    provinces: {
        type: Object,
    },
    timezones: {
        type: Object,
    },
    user: {
        type: Object
    }
});

let button = "Update";

const form = useForm({
    user_id: props.user.id,
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    address: props.user.address,
    phone_number: props.user.phone_number,
    city: props.user.city,
    province: props.user.province,
    timezone: props.user.timezone,
});

function submit() {
    if (form.first_name == null || form.last_name == null || form.address == null || form.phone_number == null || form.city == null || form.province == null || form.timezone == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    button = "Updating"

    form.post(route('user.update'), {
        onFinish: () => {
            button = "Update";
            Toast.fire({
                icon: 'success',
                title: 'User Details Updated'
            })
        },
        onSuccess: () => {
            button = "Update";
        },
    });

}

</script>

<template>
    <Head title="User Profile" />

    <AuthenticatedLayout>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Profile </h3>
            </div>

            <div class="block-content">
                <div class="row">
                    <div class="col-md-6">

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
                                <td><span class="fw-bold">{{ $page.props.user.name }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Email</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.email }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Address</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.address }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Phone Number</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.phone_number }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">City</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.city }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Province</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.province }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Status</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.status }}</span> </td>
                              </tr>
                              <tr>
                                <td><a class="fw-semibold">Timezone</a></td>
                                <td><span class="fw-bold">{{ $page.props.user.timezone }}</span> </td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="col-md-6">
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
                            <button class="btn btn-primary btn-primary-custom" type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                <i class="fa fa-check opacity-50 me-1"></i> {{ button }}
                            </button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
