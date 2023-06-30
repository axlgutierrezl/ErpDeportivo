<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import AddEditServicio from "@/Components/Tenant/AddEditServicio.vue";
import { onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const $props = defineProps(['servicios']);
const modal = ref(false);
const formulario = ref(null);
const dataServicios = ref([]);
function abrirModal(action, data = {}) {
    switch (action) {
        case 'ADD': {
            modal.value = true;
            break;
        }
        case 'EDIT': {
            modal.value = true;
            formulario.value = {
                id: data.id,
                nombre: data.nombre,
                precio: data.precio,
                estado_alquiler: data.estado_alquiler
            }
            break;
        }
    }
}
function Listar() {
    Inertia.reload({
        only: ['servicios'],
        onSuccess: () => {
            dataServicios.value = $props.servicios;
        }
    });
}
onMounted(() => {
    Listar();
});
</script>
<template>
    <TenantLayout title="Servicios" titleBread="Listado de servicios">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Servicios', 'Lista']" class="pa-0"></v-breadcrumbs>
        </template>
        <CardView>
            <template #title>
                <v-row>
                    <v-col cols="12" md="12">
                        <v-btn class="float-right" color="teal-darken-2" @click.prevent="abrirModal('ADD')">
                            <v-icon icon="mdi:mdi-plus"></v-icon>
                            Agregar
                        </v-btn>
                    </v-col>
                </v-row>
            </template>
            <template #content>
                <v-table density="comfortable" hover>
                    <thead class="text-uppercase bg-thead-primary text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Alquiler</th>
                            <th>Fecha creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataServicios.length > 0">
                            <tr v-for="(item, index) in dataServicios" :key="index">
                                <td>{{ item.nombre }}</td>
                                <td class="text-center">{{ item.precio }}</td>
                                <td class="text-center">{{ item.estado_alquiler }}</td>
                                <td class="text-center">{{ item.fecha_creacion }}</td>
                                <td>
                                    <v-btn
                                        @click="abrirModal('EDIT',item)"
                                        icon="mdi:mdi-pencil" color="success" size="x-small" class="mr-1"></v-btn>
                                    <v-btn @click="abrirModal('DELETE', item)" icon="mdi:mdi-delete" color="red"
                                        size="x-small" class="ml-1"></v-btn>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <strong>No hay registros</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </v-table>
            </template>
        </CardView>
        <AddEditServicio v-model:show="modal" @addingServicio="Listar" v-model:formulario="formulario"/>
    </TenantLayout>
</template>