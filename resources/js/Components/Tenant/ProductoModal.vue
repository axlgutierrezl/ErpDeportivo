<script setup>
import axios from 'axios';
import { onMounted, ref, watch } from 'vue';
import Pagination from "@/Components/Pagination.vue";
import { FormatNumber } from "@/helpers.js";

const $props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});
const emit = defineEmits(['update:show','SelectedProduct']);

const page = ref(1);
const search = ref("");
const dataProductos = ref([]);
const producto = ref(null);
const itemSelected = ref(null);
async function Listar() {
    try {
        itemSelected.value = null;
        const { data } = await axios.get(route('tenant.almacen.productos.getProductos'), {
            params: {
                page: page.value,
                search: search.value
            }
        });
        producto.value = data;
    } catch (ex) {

    }
}
watch(page, Listar);
watch(search,()=>{
    page.value = 1;
    Listar();
});

watch(producto, (value) => {
    dataProductos.value = value.data;
})
function cerrarModal(modal=true) {
    page.value = 1;
    search.value = "";
    if(modal){
        emit("update:show", false);
    }
    itemSelected.value = null;
}
function PintaRow(index) {
    itemSelected.value = Number(index);
}
function SeleccionarItem(item){
    emit('SelectedProduct',item);
    cerrarModal(false);
}
onMounted(() => {
    Listar();
});

</script>
<template>
    <v-dialog v-model="show" max-width="1200">
        <v-card subtitle="Instrucciones: Doble click en el registro del producto.">
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-text-field v-model="search" label="Busqueda" variant="outlined" density="comfortable"></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="12">
                        <v-table density="comfortable">
                            <thead class="text-uppercase bg-thead-primary text-center">
                                <tr>
                                    <th>Producto</th>
                                    <th>UM</th>
                                    <th>Cantidad</th>
                                    <th>Cod. Barra</th>
                                    <th>P. Venta</th>
                                    <th>P. Compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="dataProductos.length > 0">
                                    <tr v-for="(item, index) in dataProductos" :key="index" @click="PintaRow(index)"
                                        :class="index == itemSelected ? 'bg-purple-darken-1' : ''" @dblclick="SeleccionarItem(item)">
                                        <td>{{ item.nombre }}</td>
                                        <td class="text-center">{{ item.unidad_medida }}</td>
                                        <td class="text-center">{{ item.stock }}</td>
                                        <td class="text-center">{{ item.codigo_barra }}</td>
                                        <td class="text-center">{{ FormatNumber(item.precio_venta, 2, true, 'PE') }}</td>
                                        <td class="text-center">{{ FormatNumber(item.precio_compra, 2, true, 'PE') }}</td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="6" class="text-center"><strong>No hay registros</strong></td>
                                    </tr>
                                </template>
                            </tbody>
                        </v-table>
                        <Pagination :paginate="producto" v-model:page="page" />
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click.prevent="cerrarModal">Cerrar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
