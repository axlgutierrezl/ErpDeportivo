<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import { onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AddEditMarca from "@/Components/Tenant/AddEditMarca.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from 'vue-toastification';


const $props = defineProps(['flash', 'marcas']);
const modal = ref(false);
const dataMarca = ref([]);
const modalExcel = ref(false);
const formFileMarca = useForm({
    fileMarca: null
});
const toast = useToast();
const formulario = ref({
    id: 0,
    nombre: ''
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
            formulario.value.nombre = data.nombre;
            break;
        }
        case 'DELETE': {
            break;
        }
    }
}

function Listar() {
    Inertia.reload({
        only: ['marcas'],
        onSuccess: () => {
            dataMarca.value = $props.marcas;
        }
    })
}
function SubirMarcaExcel() {
    formFileMarca.post(route('importexcel.marca'), {
        forceFormData: true,
        onSuccess: () => {
            if ($props.flash.error) {
                toast.error($props.flash.error);
            } else {
                cerrarModalExcel();
                toast.success($props.flash.success);
                Listar();
            }
        },
        onError: () => {
            toast.error($props.flash.error, { timeout: 600 });
        }
    })
}
function abrirModalExcel() {
    modalExcel.value = true;
}
function cerrarModalExcel() {
    modalExcel.value = false;
    formFileMarca.clearErrors();
    formFileMarca.reset();
}
onMounted(() => {
    Listar();
})

</script>
<template>
    <TenantLayout title="Marcas" titleBread="Listado de marcas">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Marcas', 'Lista']" class="pa-0"></v-breadcrumbs>
        </template>
        <CardView>
            <template #title>
                <v-btn class="float-right" color="teal-darken-2" @click.prevent="abrirModal('ADD')">
                    <v-icon icon="mdi:mdi-plus"></v-icon>
                    Agregar
                </v-btn>
                <v-btn class="float-right mr-1" color="teal" variant="outlined" @click.prevent="abrirModalExcel">
                    <v-icon icon="mdi:mdi-file-excel-outline"></v-icon>
                    Importar Excel
                </v-btn>
            </template>
            <template #content>
                <v-table density="comfortable" hover>
                    <thead class="text-uppercase bg-thead-primary">
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha creación</th>
                            <th class="text-center">N° Productos</th>
                            <th class="text-center">estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataMarca.length > 0">
                            <tr v-for="(item, index) in dataMarca" :key="index">
                                <td class="text-center">{{ item.nombre }}</td>
                                <td class="text-center">{{ item.fecha_creacion }}</td>
                                <td class="text-center">{{ item.total_productos }}</td>
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
                                <td colspan="4" class="text-center">
                                    <strong>No hay registros</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </v-table>
            </template>
        </CardView>
        <AddEditMarca v-model:show="modal" v-model:formulario="formulario" @addingMarca="Listar" />
        <v-dialog v-model="modalExcel" max-width="550" persistent>
            <v-form @submit.prevent="SubirMarcaExcel">
                <v-card append-icon="mdi:mdi-file-excel-outline" title="Subir el Excel"
                    subtitle="Nota: Si la marca esta registrada en el sistema, no se registrará de nuevo">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-btn :href="route('modeloexcel.marca')" block variant="outlined" color="orange">
                                    <v-icon icon="mdi:mdi-file-excel"></v-icon>
                                    Descargar modelo
                                </v-btn>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-file-input @input="formFileMarca.fileMarca = $event.target.files[0]"
                                    :show-size="1000" hide-details prepend-icon="" variant="outlined"
                                    prepend-inner-icon="mdi:mdi-file-excel" label="Seleccionar archivo"></v-file-input>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="cerrarModalExcel">Cerrar</v-btn>
                        <v-btn type="submit">Guardar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </TenantLayout>
</template>