<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';

// import AuthenticationCard from '@/Components/AuthenticationCard.vue';
// import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
// import Checkbox from '@/Components/Checkbox.vue';
// import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
      <AuthLayout title="Registrarse">
        <h2 class="font-weight-bold mt-4 text--darken-2">Registrarse</h2>
        <h6 class="text-subtitle-1 text-grey-darken-1">
            ¿Ya tienes una cuenta?
            <v-btn flat variant="text" class="text-primary" @click="$inertia.visit(route('login'))">
                iniciar sesión
            </v-btn>
        </h6>
        <v-form class="mt-7" @submit.prevent="submit">
          
          <v-text-field label="Nombre" variant="outlined" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
          <v-text-field label="Email" variant="outlined" v-model="form.email" :error-messages="form.errors.email"></v-text-field>
          <v-text-field type="password" label="Contraseña" variant="outlined" v-model="form.password" :error-messages="form.errors.password"></v-text-field>
          <v-text-field type="password" label="Confirmar contraseña" variant="outlined"  v-model="form.password_confirmation" :error-messages="form.errors.password_confirmation"></v-text-field>
          <div class="d-flex align-center mb-sm-0">
              <v-checkbox  label="Acepto los términos y la privacidad" v-model="form.terms" :error-messages="form.errors.terms"></v-checkbox>
              
          </div>
          <v-btn block title="Registrar" type="submit">Registrar</v-btn>
      </v-form>
    </AuthLayout>

    <!-- <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard> -->
</template>
