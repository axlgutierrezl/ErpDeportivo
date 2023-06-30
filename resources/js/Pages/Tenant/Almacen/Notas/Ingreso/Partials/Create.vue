<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import { Inertia } from '@inertiajs/inertia';
import { onMounted, ref, watch } from 'vue';
import { useToast } from 'vue-toastification';
import { FormatNumber } from "@/helpers.js";
import { useForm } from '@inertiajs/inertia-vue3';

const $props = defineProps(['consultas', 'fecha']);
const toast = useToast();
const dataMonedas = ref([]);
const dataOrigen = ref([]);
const dataDestino = ref([]);
const dataMotivoTraslado = ref([]);
const dataAlmacen = ref([]);
const dataProductos = ref([]);
const cantidad = ref("");
const costoTotal = ref("");
const producto = ref(null);
const modal = ref(false);
const almacen = ref(null);
const motivotraslado = ref(null);

let detalles = ref([]);
const itemDetalle = ref({
    producto_id: 0,
    cantidad: 0,
    costo: 0,
    producto: ''
});
const fechaActual = ref(null);
const moneda = ref(null);
const totales = ref(0);
const  formulario = useForm({
    id:0,
    fecha:'',
    origen:0,
    destino:0,
    moneda:'',
    detalles:[],
    total:0,
    observacion:''
})
function getTables() {
    Inertia.reload({
        only: ['consultas'],
        onSuccess: () => {
            dataMonedas.value = $props.consultas.monedas;
            dataAlmacen.value = $props.consultas.almacenes;
            dataProductos.value = $props.consultas.productos;
            dataMotivoTraslado.value = $props.consultas.motivoTraslado;
            fechaActual.value = $props.fecha;
        }
    });
}

watch(fechaActual,(data)=>{
    formulario.fecha = data;
});
watch(moneda,(data)=>{
    formulario.moneda = data.descripcion;
});

watch(motivotraslado,(data)=>{
    formulario.origen = 0;
    if(data){
        formulario.origen = data.id;
    }
});

watch(almacen,(data)=>{
    formulario.destino = 0;
    if(data){
        formulario.destino = data.id;
    }
});

watch(dataMonedas, (data) => {
    moneda.value = data[0];
});

watch(producto, (data) => {
    if (data) {
        itemDetalle.value.producto_id = data.id;
        itemDetalle.value.producto = data.nombre;
    } else {
        itemDetalle.value.producto_id = 0;
        itemDetalle.value.cantidad = 0;
        itemDetalle.value.costo = 0;
        itemDetalle.value.producto = '';
        cantidad.value = '';
        costoTotal.value = '';
    }
});

watch(cantidad, (data) => {
    let cant = isNaN(Number(data)) ? 0 : Number(data);
    let prec = isNaN(Number(costoTotal.value)) ? 0 : Number(costoTotal.value);
    itemDetalle.value.costo = FormatNumber((prec / cant), 4);
    itemDetalle.value.cantidad = cant;
});

watch(costoTotal, (data) => {
    let cant = isNaN(Number(cantidad.value)) ? 0 : Number(cantidad.value);
    let prec = isNaN(Number(data)) ? 0 : Number(data);
    itemDetalle.value.costo = FormatNumber((prec / cant), 4);
});

function addDetalle() {
    try {
        let item = itemDetalle.value;
        if (item.producto_id == 0)
            throw "Seleccione un producto.";
        if (item.cantidad == 0)
            throw "ingrese una cantidad";
        if (item.costo <= 0)
            throw "ingrese un costo mayor a 0";
        let existe = detalles.value.find(x => x.producto_id == item.producto_id);
        if (existe)
            throw "El producto ya está agregado en el detalle.";

        detalles.value.push({
            producto_id: item.producto_id,
            cantidad: item.cantidad,
            costo: item.costo,
            producto: item.producto,
            total: Number(FormatNumber((item.costo * item.cantidad), 4))
        });
        producto.value = null;
        costoTotal.value = '';
        cantidad.value = '';

    } catch (ex) {
        toast.error(ex, { timeout: 1000 });
    }
}
watch(detalles.value, (data) => {
    formulario.detalles = data;
    totales.value = data.reduce((sum,{total}) => Number(sum + total),0);
    formulario.total = totales.value;
});
function EditarItem(item){
    modal.value =true;
    itemDetalle.value.producto_id = item.producto_id;
    itemDetalle.value.producto = item.producto;
    itemDetalle.value.cantidad = item.cantidad;
    itemDetalle.value.costo = item.costo;
}
function cerrarModal(){
    modal.value = false;
}
function Guardar(){
    formulario.post(route('tenant.almacen.notaingreso.store'),{
        onSuccess:()=>{
            console.log("success",formulario.errors);
        },
        onError:()=>{
            if(formulario.errors.detalles){
                toast.error(formulario.errors.detalles);
            }
        }
    });
}
function Eliminar(index){
    detalles.value.splice(index,1);
}
function SaveEditarItem(){
    detalles.value.forEach(item=>{
        if(item.producto_id == itemDetalle.value.producto_id){
            item.total = Number(itemDetalle.value.costo) * Number(itemDetalle.value.cantidad);
            item.costo = Number(itemDetalle.value.costo);
            item.cantidad = Number(itemDetalle.value.cantidad);
            cerrarModal();
        }
    })
}

onMounted(() => {
    getTables();
});



</script>
<template>
    <TenantLayout title="Nota Ingreso" titleBread="Registro nueva nota de ingreso">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Notas de Ingreso', 'Registrar']" class="pa-0"></v-breadcrumbs>
        </template>
        <v-form @submit.prevent="Guardar">
            <CardView>
                <template #title>
                    Nota de ingreso
                </template>
                <template #subtitle>
                    Registrar datos de la Nota de Salida:
                </template>
                <template #content>
                    <v-row>
                        <v-col cols="12" md="2">
                            <v-text-field v-model="fechaActual" disabled label="Fecha" variant="outlined"
                                density="comfortable" type="date">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-select v-model="moneda" :items="dataMonedas" variant="outlined" density="comfortable"
                                return-object item-title="descripcion" item-value="simbolo" label="Monedas"></v-select>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-combobox  :error-messages="formulario.errors.origen" :items="dataMotivoTraslado" v-model="motivotraslado" variant="outlined" density="comfortable" return-object
                                item-title="nombre" item-value="id" label="Motivo de traslado"></v-combobox>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-select :error-messages="formulario.errors.destino" :items="dataAlmacen" v-model="almacen"  variant="outlined" density="comfortable" return-object
                                item-title="descripcion" item-value="id" label="Destino"></v-select>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-textarea rows="2" variant="outlined" v-model="formulario.observacion" label="Observacion" density="comfortable"></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-combobox v-model="producto" :items="dataProductos" return-object item-value="id"
                                item-title="nombre" variant="outlined" density="comfortable" label="Productos">
                            </v-combobox>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field v-model="cantidad" variant="outlined" density="comfortable" label="Cantidad">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-text-field v-model="costoTotal" variant="outlined" density="comfortable"
                                label="Costo(total)"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-btn type="button" block size="large" color="info" @click="addDetalle">
                                <v-icon icon="mdi:mdi-plus"></v-icon>
                                Agregar
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-table density="comfortable" hover>
                                <thead class="text-uppercase bg-thead-primary">
                                    <tr>
                                        <th class="text-center" style="width:10%">Accion</th>
                                        <th class="text-center" style="width:10%">Cantidad</th>
                                        <th class="text-center" style="width:60%">Producto</th>
                                        <th class="text-center" style="width:10%">Costo Uni.</th>
                                        <th class="text-center" style="width:10%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="detalles.length > 0">
                                        <tr v-for="(item, index) in detalles" :key="index">
                                            <td class="text-center">
                                                <v-btn color="blue" @click.prevent="EditarItem(item)" icon="mdi:mdi-pencil" size="x-small" class="mr-1"></v-btn>
                                                <v-btn color="red" icon="mdi:mdi-delete" class="ml-1" @click.prevent="Eliminar(index)" size="x-small"></v-btn>
                                            </td>
                                            <td class="text-center">{{ item.cantidad }}</td>
                                            <td>{{ item.producto }}</td>
                                            <td class="text-center">{{ FormatNumber(item.costo, 4, true,formulario.moneda == 'SOLES' ? 'PE' : 'US') }}</td>
                                            <td class="text-center">{{ FormatNumber(item.total, 2, true,formulario.moneda == 'SOLES' ? 'PE' : 'US')
                                            }}</td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="5">
                                                <strong>No hay items</strong>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right">
                                            Total
                                        </td>
                                        <td class="text-center">
                                            {{ FormatNumber(totales, 2,true,formulario.moneda == 'SOLES' ? 'PE' : 'US') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </v-table>
                        </v-col>
                    </v-row>
                </template>
                <template #actions>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click.prevent="$inertia.visit(route('tenant.almacen.notaingreso.index'))">
                            <v-icon icon="mdi:mdi-arrow-left"></v-icon>
                            Regresar
                            </v-btn>
                        <v-btn type="submit">
                            <v-icon icon="mdi:mdi-content-save"></v-icon>
                            Guardar
                        </v-btn>
                    </v-card-actions>
                </template>
            </CardView>
        </v-form>
        <v-dialog v-model="modal" max-width="450">

            <v-card title="Editar">
                <v-card-text>
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-text-field disabled v-model="itemDetalle.producto" label="Producto" density="comfortable" variant="outlined"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field v-model="itemDetalle.cantidad" label="Cantidad" density="comfortable" variant="outlined"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field label="Costo U." v-model="itemDetalle.costo" density="comfortable" variant="outlined"></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click.prevent="cerrarModal">Cerrar</v-btn>
                    <v-btn @click.prevent="SaveEditarItem">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </TenantLayout>
</template>