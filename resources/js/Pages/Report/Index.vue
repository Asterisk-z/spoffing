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

const sites = [
    { "name" : "Google SafeBrowsing", "link" : "https://safebrowsing.google.com/safebrowsing/report_phish/"},
    { "name" : "Microsoft", "link" : "https://www.microsoft.com/en-us/wdsi/support/report-unsafe-site"},
    { "name" : "Fortiguard", "link" : "https://www.fortiguard.com/webfilter"},
    { "name" : "BrightCloud", "link" : "https://www.brightcloud.com/tools/url-ip-lookup.php"},
    { "name" : "CRDF", "link" : "https://threatcenter.crdf.fr/submit_url.html"},
    { "name" : "Netcraft", "link" : "https://report.netcraft.com/report"},
    { "name" : "Palo Alto Networks", "link" : "https://urlfiltering.paloaltonetworks.com/"},
    { "name" : "ESET", "link" : "https://phishing.eset.com/en-us/report"},
    { "name" : "Trend Micro", "link" : "https://global.sitesafety.trendmicro.com/index.php"},
    { "name" : "BitDefender", "link" : "https://www.bitdefender.com/consumer/support/answer/29358/"},
    { "name" : "McAfee", "link" : "https://sitelookup.mcafee.com/"},
    { "name" : "Forcepoint", "link" : "https://csi.forcepoint.com/"},
    { "name" : "Symantec", "link" : "https://sitereview.symantec.com/#/"},
    { "name" : "Spam404", "link" : "https://www.spam404.com/report.html"},
    { "name" : "Kaspersky", "link" : "https://opentip.kaspersky.com/"},
    { "name" : "Cisco Talos", "link" : "https://talosintelligence.com/reputation_center"},
]



</script>

<template>
    <Head title="Organization" />

    <AuthenticatedLayout>
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header px-5">
                    <a class="btn btn-info mr-3 text-capitalize" :href="route('organization')">Back</a>
                    <h2 class="block-title">Report</h2>
                </div>
                <div class="block-content pb-5 px-5">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Report</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(site, index) in sites">
                                <td><a class="fw-semibold">{{ ++index }}</a></td>
                                <td><a class="fw-semibold">{{ site.name }}</a></td>
                                <td><a class="fw-semibold btn btn-danger" :href="site.link" target="__blank">Goto site</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
