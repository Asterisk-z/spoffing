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
    domain: {
        type: Object,
    },
    details: {
        type: Object,
    },
});

const form = useForm({
    domain: props.domain.name,
    organization_id: props.organization.id,
    domain_id: props.domain.id,
});

const domain = () => {

    form.post(route('domain.detail'), {
        onFinish: () => {
            Toast.fire({
                icon: 'success',
                title: 'Organization Search Complete'
            })
        },
        onSuccess: () => { },
    });

}

domain();

</script>

<template>
    <Head title="Domain" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header px-5">
                    <h1 class="block-title" style="font-size: 30px;">{{ props.domain.name }}</h1>
                     <div class="spinner-grow spinner-border-sm text-dark" role="status" v-if="form.processing">
                        <span class="sr-only">Loading...</span>
                      </div>
                </div>
            </div>
            <!-- {{ JSON.parse(props.details?.links) }} -->
                <!-- <div class="block-content"> -->
                <div class="block block-rounded row g-0 overflow-hidden">
                    <div class="row">
                     <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-4 col-xxl-2 rounded-0" role="tablist">
                      <li class="nav-item d-md-flex flex-md-column">
                        <button class="nav-link fs-sm text-md-start rounded-0 active" id="btabs-vertical-info-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-home" role="tab" aria-controls="btabs-vertical-info-home" aria-selected="true">
                          <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>General</span>
                          <p class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2 mb-0"> </p>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button class="nav-link fs-sm text-md-start rounded-0" id="btabs-vertical-info-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-profile" role="tab" aria-controls="btabs-vertical-info-profile" aria-selected="false">
                          <i class="fa fa-fw fa-user-circle opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Risk</span>
                          <p class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2 mb-0"> </p>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button class="nav-link fs-sm text-md-start rounded-0" id="btabs-vertical-info-props-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-props" role="tab" aria-controls="btabs-vertical-info-props" aria-selected="false">
                          <i class="fa fa-fw fa-cog opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Properties</span>
                          <p class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2 mb-0"></p>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button class="nav-link fs-sm text-md-start rounded-0" id="btabs-vertical-info-links-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-links" role="tab" aria-controls="btabs-vertical-info-links" aria-selected="false">
                          <i class="fa fa-fw fa-cog opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Links</span>
                          <p class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2 mb-0"></p>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content col-md-8 col-xxl-9">
                      <div class="block-content tab-pane active" id="btabs-vertical-info-home" role="tabpanel" aria-labelledby="btabs-vertical-info-home-tab" tabindex="0">
                        <h4 class="fw-semibold" style="font-size: 28px;">General</h4>
                                            <!-- props.details?.links -->
                        <template v-if="false">
                            <template v-for="(linkValue, linkName, index) in JSON.parse(props.details?.links)" v-bind:key="linkValue">

                                <h3 class="fw-bold" style="font-size: 25px;">{{ linkName }}</h3>

                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 200px;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(value, name, index) in linkValue" v-bind:key="value">

                                            <tr v-for="(mainValue, mainName, mainindex) in value" v-bind:key="mainValue">
                                                <template v-if="mainName != 'summary'">
                                                    <td><a class="fw-semibold">{{ mainName }}</a></td>
                                                    <td><span class="fw-bold">{{ mainValue }}</span> </td>
                                                </template>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>
                            </template>
                        </template>
                      </div>
                      <div class="block-content tab-pane" id="btabs-vertical-info-profile" role="tabpanel" aria-labelledby="btabs-vertical-info-profile-tab" tabindex="0">
                            <h4 class="fw-semibold" style="font-size: 28px;">Risk Factors</h4>
                                        <!-- props.details?.links -->
                            <template v-if="props.details?.riskfactors">

                                    <!-- <h3 class="fw-bold" style="font-size: 25px;">{{ linkName }}</h3> -->

                                    <table class="table table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 400px;"></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr v-for="(linkValue, linkName, index) in JSON.parse(props.details?.riskfactors)" v-bind:key="linkValue">
                                                    <!-- <template v-if="mainName != 'summary'"> -->
                                                        <td><a class="fw-semibold">{{ linkValue.description }}</a></td>
                                                        <td><span class="fw-bold">{{ linkValue.risk }}</span> </td>
                                                    <!-- </template> -->
                                                </tr>

                                        </tbody>
                                    </table>
                            </template>
                      </div>
                      <div class="block-content tab-pane" id="btabs-vertical-info-settings" role="tabpanel" aria-labelledby="btabs-vertical-info-settings-tab" tabindex="0">
                        <h4 class="fw-semibold">Redirect</h4>

                             <h4 class="fw-semibold" style="font-size: 28px;">Redirect</h4>

                            <template v-if="props.details?.links">
                                <template v-for="(linkValue, linkName, index) in JSON.parse(props.details?.redirects)" v-bind:key="linkValue">

                                    <h3 class="fw-bold" style="font-size: 25px;">{{ linkName }}</h3>
                                </template>
                            </template>
                      </div>
                      <div class="block-content tab-pane" id="btabs-vertical-info-props" role="tabpanel" aria-labelledby="btabs-vertical-info-settings-tab" tabindex="0">
                          <h4 class="fw-semibold" style="font-size: 28px;">Properties</h4>
                            <!-- props.details?.links -->
                            <template v-if="props.details?.links">
                                <template v-for="(linkValue, linkName, index) in JSON.parse(props.details?.properties)" v-bind:key="linkValue">

                                    <h3 class="fw-bold" style="font-size: 25px; text-transform: text-uppercase;">{{ linkName.toUpperCase() }}</h3>

                                    <table class="table table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 200px;"></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <template v-for="(value, name, index) in linkValue" v-bind:key="value"> -->

                                                <tr v-for="(mainValue, mainName, mainindex) in linkValue" v-bind:key="mainValue">
                                                    <template v-if="mainName != 'summary'">
                                                        <td><a class="fw-semibold">{{ mainName }}</a></td>
                                                        <td><span class="fw-bold">{{ mainValue }}</span> </td>
                                                    </template>
                                                </tr>
                                            <!-- </template> -->

                                        </tbody>
                                    </table>
                                </template>
                            </template>
                      </div>
                      <div class="block-content tab-pane" id="btabs-vertical-info-links" role="tabpanel" aria-labelledby="btabs-vertical-info-settings-tab" tabindex="0">
                        <h4 class="fw-semibold" style="font-size: 28px;">Links</h4>
                        <!-- props.details?.links -->
                        <template v-if="props.details?.links">
                            <template v-for="(linkValue, linkName, index) in JSON.parse(props.details?.links)" v-bind:key="linkValue">

                                <h3 class="fw-bold" style="font-size: 25px;">{{ linkName }}</h3>

                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 200px;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(value, name, index) in linkValue" v-bind:key="value">

                                            <tr v-for="(mainValue, mainName, mainindex) in value" v-bind:key="mainValue">
                                                <template v-if="(mainName != 'summary') && (!mainName.includes('base64')) && mainValue">
                                                    <td><a class="fw-semibold">{{ mainName }}</a></td>
                                                    <td><span class="fw-bold">{{ mainValue }}</span> </td>
                                                </template>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>
                            </template>
                        </template>
                      </div>
                    </div>
                    </div>

                  </div>
                </div>

    </AuthenticatedLayout>
</template>
