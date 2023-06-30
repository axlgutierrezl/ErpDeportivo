<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
</script>
<template>
    <TenantLayout title="Nota Ingreso" titleBread="Editar nota ingreso">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Notas de Ingreso', 'Editar']" class="pa-0"></v-breadcrumbs>
        </template>
    </TenantLayout>
</template>