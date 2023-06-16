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
    organization: {
        type: Object,
    },
});

const form = useForm({
    name: props.organization.name,
});

function submit() {
    if (form.name == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    router.post('/organization-search', form)

    Toast.fire({
        icon: 'success',
        title: 'Organization Created Successfully'
    })

}

</script>

<template>
    <Head title="Organization" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header px-5">
                    <h2 class="block-title">{{ organization.name }}</h2>
                    <a class="btn btn-info mr-3 text-capitalize" @click="submit" >Search Similar Domain</a>
                </div>
                <div class="block-content pb-5 px-5">

                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Organization</th>
                                <th>Other Domain </th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr v-for="(organization, index) in $page.props.organizations" v-bind:key="organization">
                                <td><a class="fw-semibold">{{ ++index }}</a></td>
                                <td><a class="fw-semibold">{{ organization.name }}</a></td>
                                <td><a class="fw-semibold">{{ '0' }}</a></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View Organization" :href="route('organization.view', [organization.name, organization.id] )">
                                      <i class="fa fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
