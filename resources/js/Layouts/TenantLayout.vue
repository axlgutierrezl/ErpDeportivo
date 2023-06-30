<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import SidebarTenant from "@/Components/Tenant/SidebarTenant.vue";
import BreadCrumb from '@/Components/LandLord/Partials/BreadCrumb.vue';
import { onMounted, ref, watch, onBeforeMount,onUnmounted } from 'vue';
import { useDisplay } from 'vuetify'
import { Inertia } from '@inertiajs/inertia';

defineProps({
    title: String,
    titleBread: String
});
const overlay = ref(false);
const drawer = ref(false);
const rail = ref(true);
const permanent = ref(true);
watch(drawer, (data) => {
    rail.value = permanent.value ? true : drawer.value;
});

const logout = () => {
    Inertia.post(route('logout'));
};


onUnmounted(()=>{
    overlay.value = true;
    console.log("onUnmounted",overlay.value);
});

onBeforeMount(()=>{
    // overlay.value = true;
    console.log("onBeforeMount",overlay.value);
});
onMounted(() => {
    let { mobile } = useDisplay();
    permanent.value = !mobile.value;
    rail.value = permanent.value ? true : drawer.value;
});
</script>
<template>

    <Head :title="title" />
    <v-app>
        <v-app-bar elevation="0" class="px-4">
            <div class="pa-4 pl-1">
                <div class="logo">
                    <a href="/" class="router-link-active d-flex">
                        <img src="https://adminpro-vuetify-dark.netlify.app/assets/white-logo-icon.6bfee9b1.svg">
                        <img src="https://adminpro-vuetify-dark.netlify.app/assets/white-logo-text.7766c51f.svg"
                            class="pl-3">
                    </a>
                </div>
            </div>
            <v-app-bar-nav-icon icon="mdi:mdi-menu" variant="text" @click.stop="drawer = !drawer">
            </v-app-bar-nav-icon>
            <v-spacer></v-spacer>
            <v-menu rounded>
                <template v-slot:activator="{ props }">
                    <v-btn flat variant="text" elevation="0" icon v-bind="props">
                        <v-avatar>
                            <img :src="$page.props.user.profile_photo_url">
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card width="200">
                    <v-card-text>
                        <v-list density="compact">
                            <v-list-item title="Perfil" value="perfil">
                                <template v-slot:prepend>
                                    <v-icon icon="mdi:mdi-account" class="mr-2"></v-icon>
                                </template>
                            </v-list-item>
                            <v-list-item title="Salir" value="salir" @click.prevent="logout">
                                <template v-slot:prepend>
                                    <v-icon icon="mdi:mdi-logout" class="mr-2"></v-icon>
                                </template>
                            </v-list-item>
                            <!-- <h4 class="font-weight-medium fs-18">Perfil de usuario</h4>

                            <div class="d-flex align-center my-4">
                                <img :src="$page.props.user.profile_photo_url" width="80" class="rounded-circle" />
                                <div class="ml4">

                                </div>
                            </div> -->

                        </v-list>
                    </v-card-text>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer :permanent="permanent" v-model="rail" :rail="permanent ? drawer : false" expand-on-hover>
            <v-list>
                <v-list-item :prepend-avatar="$page.props.user.profile_photo_url" :title="$page.props.user.name"
                    :subtitle="$page.props.user.email">
                </v-list-item>
            </v-list>

            <v-divider></v-divider>
            <SidebarTenant />
        </v-navigation-drawer>
        <v-main>
            <v-container fluid class="fill-height" style="position:relative;">
                <BreadCrumb :title="titleBread">
                    <template #breadcrumb>
                        <slot name="itemBreadCrumb" />
                    </template>
                </BreadCrumb>
                <slot />
                
                <v-overlay v-model="overlay" contained class="align-center justify-center">
                    <v-btn color="success" @click="overlay = false">
                        Hide Overlay
                    </v-btn>
                </v-overlay>
            </v-container>
        </v-main>
    </v-app>
</template>
<style scoped>
@media only screen and (max-width: 600px) {
    .logo {
        width: 40px;
        overflow: hidden;
    }
}
</style>
