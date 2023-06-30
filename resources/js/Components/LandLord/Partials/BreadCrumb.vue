<script setup>
defineProps({
    title: {
        type: String,
        required: true
    }
});
</script>
<template>
    <v-row class="page-breadcrumb mb-1">
        <v-col cols="12" sm="12">
            <v-toolbar density="compact" theme="dark" color="transparent" class="pa-0"> 
                <div>
                    <h3 class="pa-1 text-uppercase text-grey">{{ title }}</h3>
                    <slot name="breadcrumb" />
                </div>
            </v-toolbar>

        </v-col>
    </v-row>
</template>
<style>
.page-breadcrumb .v-toolbar__content{
    height: 64px!important;
}
</style>