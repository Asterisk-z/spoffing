<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    provinces: {
        type: Object,
    },
    timezones: {
        type: Object,
    }
});


const form = useForm({
    first_name: '',
    last_name: '',
    address: '',
    phone_number: '',
    city: '',
    province: '',
    timezone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
        <Head title="Register" />

            <div id="page-container" class="main-content-boxed">

          <!-- Main Container -->
          <main id="main-container">
            <!-- Page Content -->
            <div class="bg-body-dark">
              <div class="row mx-0 justify-content-center">
                <div class="hero-static col-lg-6 col-xl-4">
                  <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-4 text-center">
                      <h1 class="h3 fw-bold mt-4 mb-2">Create your account</h1>
                    </div>
                    <!-- END Header -->

                    <form @submit.prevent="submit">
                      <div class="block block-themed block-rounded block-fx-shadow">
                        <div class="block-header bg-gd-dusk">
                        </div>
                        <div class="block-content">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-sm" v-model="form.first_name" required placeholder="Enter your first name">
                            <label class="form-label" >First name</label>
                            <small v-if="form.errors.name">{{ form.errors.name }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" v-model="form.last_name" required placeholder="Enter your last name">
                            <label class="form-label" >Last name</label>
                            <small v-if="form.errors.name">{{ form.errors.name }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="email" class="form-control"  v-model="form.email" required placeholder="Enter your email">
                            <label class="form-label">Email</label>
                            <small v-if="form.errors.email">{{ form.errors.email }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" v-model="form.phone_number" required placeholder="Enter your last name">
                            <label class="form-label" >Phone Number</label>
                            <small v-if="form.errors.phone_number">{{ form.errors.phone_number }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" v-model="form.city" required placeholder="Enter your last name">
                            <label class="form-label" >City</label>
                            <small v-if="form.errors.city">{{ form.errors.city }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" v-model="form.address" required placeholder="Enter your last name">
                            <label class="form-label" >Address</label>
                            <small v-if="form.errors.address">{{ form.errors.address }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <select class="form-select" v-model="form.province">
                                <option :value="null">Select A Province</option>
                                <option v-for="province in provinces" v-bind:key="province" :value="province">{{ province }}</option>
                            </select>
                            <label class="form-label" >Province</label>
                            <small v-if="form.errors.province">{{ form.errors.province }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <select class="form-select" v-model="form.timezone">
                                <option :value="null">Select A Timezone</option>
                                <option v-for="timezone in timezones" v-bind:key="timezone" :value="timezone.location">{{ timezone.time }}</option>
                            </select>
                            <label class="form-label" >Timezone</label>
                            <small v-if="form.errors.timezone">{{ form.errors.timezone }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="password" class="form-control" v-model="form.password" required placeholder="Enter your password">
                            <label class="form-label" >Password</label>
                            <small v-if="form.errors.password">{{ form.errors.password }}</small>
                          </div>
                          <div class="form-floating mb-4">
                            <input type="password" class="form-control" v-model="form.password_confirmation" required placeholder="Confirm password">
                            <label class="form-label" >Confirm Password</label>
                            <small v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</small>
                          </div>
                          <div class="row">
                            <div class="col-sm-6 d-sm-flex align-items-center push">
                              <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :href="route('login')">
                                <i class="fa fa-arrow-left opacity-50 me-1"></i> Log In
                              </a>
                            </div>
                            <div class="col-sm-6 text-sm-end push">
                              <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
                                Register
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                </div>
              </div>


            </div>

        </main>

        </div>

</template>
