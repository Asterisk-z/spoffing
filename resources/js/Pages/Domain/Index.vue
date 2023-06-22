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
    name: null,
});

function submit() {
    if (form.name == null) {
        Toast.fire({
            icon: 'error',
            title: 'All fields are required'
        })
        return;
    }

    router.post('/organization', form)

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
                    <h2 class="block-title">Organization</h2>
                    <a  class="btn btn-info mr-3 text-capitalize"   data-bs-toggle="modal" data-bs-target="#modal-normal">Add Organization</a>
                    <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded shadow-none mb-0">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Add Organization</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content fs-sm">
                                        <form  @submit.prevent="submit">

                                            <div class="col-md-12">
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <label class="form-label">Organization</label>
                                                        <input type="text" class="form-control form-control-lg"  v-model="form.name" placeholder="Enter your organization name..">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <button class="btn btn-primary btn-primary-custom" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                    <i class="fa fa-check opacity-50 me-1"></i>Create Organization
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <tr v-for="(organization, index) in $page.props.organizations" v-bind:key="organization">
                                <td><a class="fw-semibold">{{ ++index }}</a></td>
                                <td><a class="fw-semibold">{{ organization.name }}</a></td>
                                <td><a class="fw-semibold">{{ '0' }}</a></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View Organization" :href="route('organization.view', [organization.name, organization.id] )">
                                      <i class="fa fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
