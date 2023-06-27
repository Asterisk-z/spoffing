<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

defineProps({
    users: {
        type: Object,
    },
    page: {
        type: String,
    },
});


const approve = (id) => {

    const form = useForm({
        user_id: id,
    });

    form.post(route('user.approve'), {
        onFinish: () => {
            Toast.fire({
                icon: 'success',
                title: 'User Activated Successfully'
            })
        },
        onSuccess: () => {},
    });

};


const lock = (id) => {

    const form = useForm({
        user_id: id,
    });

    form.post(route('user.lock'), {
        onFinish: () => {
            Toast.fire({
                icon: 'success',
                title: 'User Deactivated Successfully'
            })
        },
        onSuccess: () => { },
    });

};



</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Users list </h3>
                <Link :href="route('users.list.pending')" class="btn btn-info mr-3" v-if="$page.props.page != 'pending'">Pending User</Link>
                <Link :href="route('users.list')" class="btn btn-info mr-3" v-if="$page.props.page != 'users'">All Users</Link>
                <Link :href="route('user.create')" class="btn btn-outline-info mr-3">Create User</Link>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th class="text-center"></th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">City</th>
                        <th class="text-center" style="width: 15%;">Status</th>
                        <th class="text-center" style="width: 15%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(user, index) in users" v-bind:key="user">
                        <td class="text-center">{{ ++index }}</td>
                        <td class="fw-semibold">{{ user.name }}</td>
                        <td class="d-none d-sm-table-cell">{{ user.email }}</td>
                        <td class="d-none d-sm-table-cell">
                         {{ user.city }}
                        </td>
                        <th class="text-center" style="width: 15%;">
                            <span class="badge bg-success" v-if="user.status == 'ACTIVE'">{{ user.status }}</span>
                            <span class="badge bg-warning" v-if="user.status == 'PENDING'">{{ user.status }}</span>
                            <span class="badge bg-danger" v-if="user.status == 'LOCKED'">{{ user.status }}</span>
                        </th>
                        <td class="text-center">
                          <Link @click="approve(user.id)"  class="btn btn-sm btn-success mr-1" data-bs-toggle="tooltip" title="Approve User"  v-if="user.status != 'ACTIVE'">
                            <i class="fa fa-check"></i>
                          </Link>
                          <Link  @click="lock(user.id)"  class="btn btn-sm btn-danger mr-1" data-bs-toggle="tooltip" title="Lock User"   v-if="user.status == 'ACTIVE'">
                            <i class="fa fa-times"></i>
                          </Link>
                          <Link :href="route('user.view', user.id)"  class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View User">
                            <i class="fa fa-eye"></i>
                          </Link>
                        </td>
                      </tr>

                    </tbody>
                  </table>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
