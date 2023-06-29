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
    all: {
        type: Boolean
    }
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
                title: 'Organization Search Complete'
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
                    <a class="btn btn-info mr-3 text-capitalize" :href="route('organization')">Back</a>
                    <h2 class="block-title" style="font-size: 30px;">{{ organization.name }} {{ (!$page.props.all) ? "domain for the last 24 hours" : "" }}</h2>
                    <a class="btn btn-info mr-3 text-capitalize" :href="!$page.props.all ? route('organization.view', [organization.name, organization.id]) : '#'"  :class="{ 'opacity-25': $page.props.all }" :disabled="$page.props.all">All Domain</a>
                    <a class="btn btn-info mr-3 text-capitalize" :href="$page.props.all ? route('organization.view.latest', [organization.name, organization.id]) : '#'" :class="{ 'opacity-25': !$page.props.all }"  v-bind:aria-disabled="$page.props.all">Last 24 Hours</a>
                </div>
                <div class="block-content pb-5 px-5">

                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Domain</th>
                                <th style="width: 200px;">View</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(domain, index) in $page.props.domains.data" v-bind:key="domain">
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

                    <nav aria-label="Page navigation pull-right" v-if="$page.props.domains.links.length > 3">
                        <ul class="pagination pagination-sm">
                            <template v-for="(link, p) in $page.props.domains.links" :key="p">
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
