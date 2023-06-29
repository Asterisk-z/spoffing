<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';

defineProps({
    domain: {
        type: Object,
    },
});

const form = useForm({
    domain: "",
});

let data = 'Here';

const search = () => {
    form.post(route('search.domain'), {
        onFinish: ($response) => {
            console.log($response);
            data = $response
        },
        onSuccess: () => { },
    });
}
</script>

<template>
    <Head title="Welcome" />

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm p-0" id="mainNav">
        <div class="container-fluid px-5 py-5 navbar-top">
            <!-- <a class="navbar-brand fw-bold" href="#page-top">Yespoff</a> -->
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <!-- <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Download</a></li> -->
            </ul>
            <a class=" px-3 mb-2 mb-lg-0 mr-5">
                <span class="d-flex align-items-center">
                    <span class="large text-black text-uppercase font-bolder">Contact Us</span>
                </span>
            </a>
            <a class="btn btn-secondary px-3 mb-2 mb-lg-0 mr-5" :href="route('login')" style="background-color: black; ">
                <span class="d-flex align-items-center">
                    <span class="large">Sign Up</span>
                </span>
            </a>
            <a class="btn btn-secondary px-3 mb-2 mb-lg-0" :href="route('login')" style="background-color: black; ">
                <span class="d-flex align-items-center">
                    <span class="large">Login</span>
                </span>
            </a>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5 py-8">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-base mb-3 text-white text-uppercase"
                            style="font-weight: 900; font-size: 100px;">Spoffing<br> Spoofng</h1>
                        <p class="lead fw-normal text-white mb-5" style="font-weight: 900; font-size: 30px;">Detect and
                            report Spoofing websites!</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <form>
                                <div class="input-group w-[550px] ">
                                    <input type="text" class="form-control py-3 text-black" placeholder="Search Domain"
                                        v-model="form.domain">
                                    <button type="button" class="btn btn-secondary px-5" style="background-color: black; "
                                        @click="search">
                                        <div class="spinner-grow spinner-border-sm text-white" role="status"
                                            v-if="form.processing">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Masthead device mockup feature-->
                    <div class="masthead-device-mockup">
                        <img class="img-fluid" src="assets/media/photos/expre.svg" alt="Hero Promo">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Domain List</h3>
                <div class="block-options">
                </div>
            </div>
            <div class="block-content">
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;"></th>
                            <th>Domain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in domain">
                            <th class="text-center" scope="row">{{ ++index }}</th>
                            <td>{{ item }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.masthead {
    background-color: red;
    height: 100vh;
}

.navbar-top {
    background-color: red;
}
</style>
