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
    domains: {
        type: Object,
    },
});

const form = useForm({
    name: props.organization.name,
    organization_id: props.organization.id,
});

function search() {
    form.post(route('organization.search'), {
        onFinish: () => {
            Toast.fire({
                icon: 'success',
                title: 'Organization Search  Complete'
            })
        },
        onSuccess: () => {},
    });
}

</script>

<template>
    <Head title="Organization" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header px-5">
                    <h2 class="block-title" style="font-size: 30px;">{{ organization.name }}</h2>
                    <a class="btn btn-info mr-3 text-capitalize" @click="search" v-if="!form.processing">Search Similar Domain</a>
                    <a class="btn btn-info mr-3 text-capitalize" v-else>  <span class="spinner-border text-dark "></span> Searching</a>
                </div>
                <div class="block-content pb-5 px-5">

                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Domain</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(domain, index) in $page.props.domains" v-bind:key="domain">
                                <td><a class="fw-semibold">{{ ++index }}</a></td>
                                <td><a class="fw-semibold">{{ domain.name }}</a></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="View domain" :href="route('domain', [organization.id, domain.id, domain.name] )">
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
