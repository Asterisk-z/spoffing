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

    form.post(route('organization'), {
        onFinish: (response) => {
            Toast.fire({
                icon: 'success',
                title: 'Organization Created Successfully'
            })

            console.log(response);
            //  search()

        },
        onSuccess: () => { },
    });

}

function cancel(id) {
    Swal.fire({
        title: 'Do you want to disable this organization?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: "No"
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const cancel_form = useForm({
                org_id: id,
            });
            cancel_form.post(route('organization.cancel'), {
                onFinish: (response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Organization Updated Successfully'
                    })
                },
                onSuccess: () => { },
            });
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
        }
    })
}

function activate(id) {

    Swal.fire({
        title: 'Do you want to disable this organization?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: "No"
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const activate_form = useForm({
                org_id: id,
            });
            activate_form.post(route('organization.activate'), {
                onFinish: (response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Organization Updated Successfully'
                    })
                },
                onSuccess: () => { },
            });
        } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
        }
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
                                                    <span class="spinner-border text-dark " v-if="form.processing"></span>
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
                            <tr v-for="(organization, index) in $page.props.organizations.data" v-bind:key="organization">
                                <td><a class="fw-semibold">{{ ++index }}</a></td>
                                <td><a class="fw-semibold">{{ organization.name }}</a></td>
                                <td><a class="fw-semibold">{{ organization.domains.length }}</a></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View Organization" :href="route('organization.view', [organization.name, organization.id] )">
                                      <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger m-2" data-bs-toggle="tooltip" title="Cancel Organization" @click="cancel(organization.id)" v-if="organization.status == 'ACTIVE'">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <a class="btn btn-sm btn-success m-2" data-bs-toggle="tooltip" title="Activate Organization" @click="activate(organization.id)" v-else>
                                        <i class="fa fa-check"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                                <nav aria-label="Page navigation pull-right" v-if="$page.props.organizations.links.length > 3">
                                    <ul class="pagination pagination-sm">
                                        <template v-for="(link, p) in $page.props.organizations.links" :key="p">
                                            <li class="page-item" v-if="link.label.includes('Previous')">
                                                <a class="page-link" :href="link.url" tabindex="-1" aria-label="Previous">
                                                    <span aria-hidden="true" class="">
                                                        <i class="fa fa-angle-double-left mr-2"></i> Previous
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="page-item" v-else-if="link.label.includes('Next')">
                                                <a class="page-link" :href="link.url" aria-label="Next">
                                                    <span aria-hidden="true" class="">
                                                        Next<i class="fa fa-angle-double-right ml-2"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="page-item" :class="{ active: link.active }" v-else>
                                                <a class="page-link" :href="link.url">{{ link.label }}</a>
                                            </li>
                                        </template>
                                     </ul>
                                </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
