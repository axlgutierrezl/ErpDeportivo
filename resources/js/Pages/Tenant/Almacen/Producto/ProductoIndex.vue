<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import Pagination from "@/Components/Pagination.vue";

import { onMounted, ref, watch } from 'vue';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
const $props = defineProps(["flash", 'productos', 'filters']);
const toast = useToast();
const dataProductos = ref([]);
const page = ref(1);
const tamanio = ref(10);
const search = ref(null);
const modalExcel = ref(false);
const formFileExcel = useForm({
    fileProducto: null
});
const formUpdateIgv = useForm({
    id: 0,
    tieneIgv: 0
});

function Listar() {
    Inertia.reload({
        only: ['productos'],
        preserveState: true,
        onSuccess: () => {
            dataProductos.value = $props.productos.data;
            if ($props.filters.tamanio) {
                tamanio.value = Number($props.filters.tamanio);
            }
            if ($props.filters.search) {
                search.value = $props.filters.search;
            }

            if ($props.filters.page) {
                page.value = Number($props.filters.page);
            }

            if ($props.flash.success) {
                toast.success($props.flash.success);
            }
            if ($props.flash.error) {
                toast.error($props.flash.error);
            }
        },
        onError: () => {
            console.log("errors")
        }
    })
}
watch(page, (data) => {
    ListarPageSearching(data);
});
watch(search, (data) => {
    page.value = 1;
    setTimeout(() => {
        ListarPageSearching();
    }, 500);
});
watch(tamanio, () => {
    page.value = 1;
    ListarPageSearching();
});
function ListarPageSearching() {
    Inertia.get(route('tenant.almacen.productos.index'), {
        page: page.value,
        search: search.value,
        tamanio: tamanio.value
    }, {
        only: ['productos'],
        preserveState: true,
        replace: true,
        onSuccess: () => {
            dataProductos.value = $props.productos.data;
        }
    });
}
function abrirModalExcel() {
    modalExcel.value = true;
}
function cerrarModalExcel() {
    modalExcel.value = false;
    formFileExcel.clearErrors();
    formFileExcel.reset();
}
function SubirProductoExcel() {
    formFileExcel.post(route('importexcel.producto'), {
        forceFormData: true,
        onSuccess: () => {
            if ($props.flash.error) {
                toast.error($props.flash.error);
            } else {
                cerrarModalExcel();
                toast.success($props.flash.success);
                page.value = 1;
                ListarPageSearching();
            }
        },
        onError: () => {
            toast.error($props.flash.error, { timeout: 600 });
        }
    })
}
function updateIgv(value) {
    dataProductos.value.forEach(item => {
        item.updateIgv = true;
    });

    formUpdateIgv.id = value.id;
    formUpdateIgv.tieneIgv = value.tiene_igv ? 0 : 1;
    try {
        formUpdateIgv.put(route('tenant.almacen.productos.updateigv', { producto: value.id }), {
            onSuccess: () => {
                if ($props.flash.success) {
                    toast.success($props.flash.success);
                }
                ListarPageSearching();
            },
            onError: () => {
                if ($props.flash.error) {
                    toast.error($props.flash.error);
                }
            }
        })
    } catch (ex) {
        console.log(ex);
    }

}
onMounted(() => {
    Listar(1);
});
</script>
<template>
    <TenantLayout title="Productos" titleBread="Listado de productos">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Productos', 'Lista']" class="pa-0"></v-breadcrumbs>
        </template>
        <CardView>
            <template #title>
                <v-row class="pt-3">
                    <v-col cols="12" md="1">
                        <v-select v-model="tamanio" hide-details label="Registros" class="text-center"
                            :items="[5, 10, 15, 25, 50, 100]" density="compact" variant="outlined"></v-select>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field v-model="search" hide-details variant="outlined" density="compact" label="Buscar"
                            append-inner-icon="mdi:mdi-magnify"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="8">
                        <v-btn class="float-right" color="teal-darken-2"
                            @click.prevent="$inertia.visit(route('tenant.almacen.productos.create'))">
                            <v-icon icon="mdi:mdi-plus" class="mr-1"></v-icon>
                            Agregar
                        </v-btn>
                        <v-btn class="float-right mr-1" color="cyan-accent-1" variant="outlined"
                            @click.prevent="abrirModalExcel">
                            <v-icon icon="mdi:mdi-file-excel-outline" class="mr-1"></v-icon>
                            Importar Excel
                        </v-btn>
                        <v-btn :href="route('exportexcel.producto')" class="float-right mr-1" color="green-accent-2" variant="outlined">
                            <v-icon icon="mdi:mdi-cloud-download" class="mr-1"></v-icon>
                            Exportar Excel
                        </v-btn>
                    </v-col>
                </v-row>

            </template>
            <template #content>

                <v-table density="comfortable" hover>
                    <thead class="text-uppercase bg-thead-primary text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Historial</th>
                            <th>Stock</th>
                            <th>S/ Venta</th>
                            <th>Tiene IGV</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataProductos.length > 0">
                            <tr v-for="(item, index) in dataProductos" :key="index">
                                <td>{{ item.nombre }}</td>
                                <td class="text-center">
                                    <v-btn icon="mdi:mdi-clipboard-text-clock" size="small" color="blue-grey-lighten-5"
                                        variant="outlined">
                                    </v-btn>
                                </td>
                                <td class="text-center">{{ item.stock }}</td>
                                <td class="text-center">{{ item.precio_venta }}</td>
                                <td class="text-center">
                                    <v-row align="center" justify="center">
                                        <v-col cols="12" md="6">
                                            <v-switch :disabled="item.updateIgv" @click="updateIgv(item)"
                                                v-model="item.tiene_igv" color="cyan-darken-1" hide-details></v-switch>
                                        </v-col>
                                    </v-row>
                                </td>
                                <td class="text-center">
                                    <v-btn
                                        @click="$inertia.visit(route('tenant.almacen.productos.edit', { id: item.id }))"
                                        icon="mdi:mdi-pencil" color="success" size="x-small" class="mr-1"></v-btn>
                                    <v-btn @click="abrirModal('DELETE', item)" icon="mdi:mdi-delete" color="red"
                                        size="x-small" class="ml-1"></v-btn>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="9" class="text-center">
                                    <strong>No hay registros</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>

                </v-table>
                <Pagination v-if="productos" :paginate="productos" v-model:page="page" />
            </template>
        </CardView>
        <v-dialog v-model="modalExcel" max-width="550" persistent>
            <v-form @submit.prevent="SubirProductoExcel">
                <v-card append-icon="mdi:mdi-file-excel-outline" title="Subir el Excel"
                    subtitle="Nota: Si la categoria esta agregada en el sistema, no se registrará de nuevo">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-btn :href="route('modeloexcel.producto')" block variant="outlined" color="orange">
                                    <v-icon icon="mdi:mdi-file-excel"></v-icon>
                                    Descargar modelo
                                </v-btn>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-file-input @input="formFileExcel.fileProducto = $event.target.files[0]"
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