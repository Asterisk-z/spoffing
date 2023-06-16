<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    users: {
        type: Object,
    },
});

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Users list  </h3>
                <a :href="route('users.list.pending')" class="btn btn-info mr-3">Approve User</a>
                <a :href="route('user.create')" class="btn btn-outline-info mr-3">Create User</a>
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
                        <th class="text-center" style="width: 15%;"> <span class="badge bg-success">Active</span></th>
                        <td class="text-center">
                          <a  class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View User">
                            <i class="fa fa-user"></i>
                          </a>
                        </td>
                      </tr>

                    </tbody>
                  </table>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
