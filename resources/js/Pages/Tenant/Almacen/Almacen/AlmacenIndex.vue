<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import AddEditAlmacen from "@/Components/Tenant/AddEditAlmacen.vue";
import { onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const modal = ref(false);
const $props = defineProps(['flash', 'almacenes']);
const dataAlmacen = ref([]);
const formulario = ref({
    id: 0,
    descripcion: '',
    ubicacion: ''
});
function abrirModal(action, data = {}) {
    switch (action) {
        case 'ADD': {
            modal.value = true;
            break;
        }
        case 'EDIT': {
            modal.value = true;
            formulario.value.id = data.id;
            formulario.value.descripcion = data.descripcion;
            formulario.value.ubicacion = data.ubicacion;
            break;
        }
        case 'DELETE': {
            break;
        }
    }
}

function Listar() {
    Inertia.reload({
        only: ['almacenes'],
        onSuccess: () => {
            dataAlmacen.value = $props.almacenes;
        }
    })
}

onMounted(() => {
    Listar();
})

</script>
<template>
    <TenantLayout title="Almacen" titleBread="Listado de almacenes">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Almacenes', 'Lista']" class="pa-0"></v-breadcrumbs>
        </template>
        <CardView>
            <template #title>
                <v-btn class="float-right" color="teal-darken-2" @click.prevent="abrirModal('ADD')">
                    <v-icon icon="mdi:mdi-plus"></v-icon>
                    Agregar
                </v-btn>
            </template>
            <template #content>
                <v-table density="comfortable" hover>
                    <thead class="text-uppercase bg-thead-primary">
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Ubicacion</th>
                            <th class="text-center">Fecha creación</th>
                            <th class="text-center">N° Productos</th>
                            <th class="text-center">estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataAlmacen.length > 0">
                            <tr v-for="(item, index) in dataAlmacen" :key="index">
                                <td class="text-center">{{ item.descripcion }}</td>
                                <td class="text-center">{{ item.ubicacion }}</td>
                                <td class="text-center">{{ item.fecha_creacion }}</td>
                                <td class="text-center">
                                    {{ item.total_productos }}
                                </td>
                                <td class="text-center">{{ item.estado }}</td>
                                <td class="text-center">
                                    <v-btn @click="abrirModal('EDIT', item)" icon="mdi:mdi-pencil" color="success"
                                        size="x-small" class="mr-1"></v-btn>
                                    <v-btn @click="abrirModal('DELETE', item)" icon="mdi:mdi-delete" color="red"
                                        size="x-small" class="ml-1"></v-btn>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <strong>No hay registros</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </v-table>
            </template>
        </CardView>
        <AddEditAlmacen v-model:show="modal" @addingAlmacen="Listar" v-model:formulario="formulario" />
    </TenantLayout>
</template>