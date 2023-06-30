<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';
const $props = defineProps(["flash", "cajas"]);
const modal = ref(false);
const formCaja = useForm({
    id: 0,
    nombre: ''
});
const toast = useToast();
const dataCajas = ref([]);
function abrirModal(action, data = {}) {
    switch (action) {
        case 'ADD': {
            modal.value = true;
            break;
        }
        case 'EDIT': {
            modal.value = true;
            formCaja.id = data.id;
            formCaja.nombre = data.nombre;
            break;
        }
        case 'DELETE': {
            break;
        }
    }
}
function Guardar() {
    let url = formCaja.id == 0 ? route('tenant.caja.store') : route('tenant.caja.update');
    let method = formCaja.id == 0 ? 'post' : 'put';
    formCaja[method](url, {
        onSuccess: () => {
            if ($props.flash.success) {
                modal.value = false;
                Limpiar();
                toast.success($props.flash.success);
                ListarCajas();
            }
        },
        onError: () => {
            if (formCaja.errors) {
                if (formCaja.errors.nombre) {
                    toast.error(formCaja.errors.nombre);
                }
            }

        }
    });
}
function ListarCajas() {
    Inertia.reload({
        only: ['cajas'],
        onSuccess: () => {
            dataCajas.value = $props.cajas;
        }
    })
}
function Limpiar() {
    formCaja.id = 0;
    formCaja.nombre = '';
}
onMounted(() => {
    ListarCajas();
});
</script>
<template>
    <TenantLayout title="Cajas" titleBread="Listado de cajas">
        <v-card>
            <v-card-title>
                <v-btn class="float-right" color="teal-darken-2" @click.prevent="abrirModal('ADD')">
                    <v-icon icon="mdi:mdi-plus"></v-icon>
                    Agregar
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-table density="comfortable">
                    <thead class="text-uppercase bg-thead-primary">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha creación</th>
                            <th>estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataCajas.length > 0">
                            <tr v-for="(item, index) in dataCajas" :key="index">
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.fechaCreacion }}</td>
                                <td>{{ item.estado }}</td>
                                <td>
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
            </v-card-text>
        </v-card>

        <DialogFormModal v-model:show="modal" @submitted="Guardar" @close="Limpiar" :processing="formCaja.processing">
            <template #title>
                <h3>{{ formCaja.id == 0 ? 'Nueva caja' : 'Editar caja' }}</h3>
            </template>
            <template #content>
                <v-row>
                    <v-col cols="12" md="12">
                        <v-text-field label="Nombre" variant="outlined" v-model="formCaja.nombre"></v-text-field>
                    </v-col>
                </v-row>
            </template>
            <template #actions>
                <v-btn type="submit" :disabled="formCaja.processing">
                    {{ formCaja.id == 0 ? 'Guardar' : 'Actualizar' }}
                </v-btn>
            </template>
        </DialogFormModal>
    </TenantLayout>
</template>