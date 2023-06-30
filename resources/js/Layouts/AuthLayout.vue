<script setup>
import { Head } from '@inertiajs/inertia-vue3';
defineProps({
    title: String
});
</script>
<template>
    <Head :title="title" />
    <v-app>
       <v-row class="h-100vh">
         <v-col cols="12" lg="7" xl="6" class="bg-info d-none d-md-flex align-center justify-center">

         </v-col>
         <v-col cols="12" lg="5" xl="6" class="d-flex align-center">
            <v-container fluid>
                <div class="pa-7 pa-sm-12">
                    <v-row>
                        <v-col cols="12" lg="9" xl="6" class="mx-auto">
                            <slot />
                        </v-col>
                    </v-row>
                </div>
            </v-container>
         </v-col>
       </v-row>
    </v-app>
</template>