<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import { useToast } from 'vue-toastification';
import { onMounted, ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import Pagination from "@/Components/Pagination.vue";

const toast = useToast();
const $props = defineProps(["notaSalida","flash",'filters']);
const tamanio = ref(5);
const search = ref(null);
const page = ref(1);
const dataSalida = ref([]);
function Lista(){
    Inertia.reload({
        only:['notaSalida'],
        onSuccess:()=>{
            dataSalida.value = $props.notaSalida.data;
            if ($props.flash.success) {
                toast.success($props.flash.success,{timeout:800});
            }
            if ($props.flash.error) {
                toast.error($props.flash.error,{timeout:1000});
            }
            if($props.filters.page){
                page.value = Number($props.filters.page);
            }
            if($props.filters.tamanio){
                tamanio.value = Number($props.filters.tamanio);
            }
        }
    });
}
watch(tamanio,(data)=>{
    page.value = 1;
    ListarPageSearching();
})
watch(page,(data)=>{
    ListarPageSearching();
});
function ListarPageSearching(){
    Inertia.get(route('tenant.almacen.notasalida.index'),{
        page:page.value,
        search:'',
        tamanio:tamanio.value
    },{

        only:['notaSalida'],
        preserveState:true,
        replace:true,
        onSuccess:()=>{
            dataIngreso.value = $props.notaSalida.data;
        }
    });
}
onMounted(()=>{
    Lista();
});
</script>
<template>
    <TenantLayout title="Nota Ingreso" titleBread="Listado de notas de salida">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Nota Salida', 'Lista']" class="pa-0"></v-breadcrumbs>
        </template>
        <CardView>
            <template #title>
                <v-row class="pt-3">
                    <v-col cols="12" md="1">
                        <v-select v-model="tamanio" hide-details label="Registros" class="text-center"
                            :items="[5, 10, 15, 25, 50, 100]" density="compact" variant="outlined"></v-select>
                    </v-col>
                    <v-col cols="12" md="3">
                        <!-- <v-text-field v-model="search" hide-details variant="outlined" density="compact" label="Buscar"
                            append-inner-icon="mdi:mdi-magnify"></v-text-field> -->
                    </v-col>
                    <v-col cols="12" md="8">
                        <v-btn class="float-right" color="teal-darken-2" @click.prevent="$inertia.visit(route('tenant.almacen.notasalida.create'))">
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
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="dataSalida.length > 0">
                            <tr v-if="(item,index) in dataSalida" :key="index">
                                <td>{{item.numero}}</td>
                                <td>{{ item.fecha }}</td>
                                <td>{{ item.origen }}</td>
                                <td>{{ item.destino }}</td>
                                <td>
                                    <v-btn icon="mdi:mdi-eye"></v-btn>
                                    <v-btn icon="mdi:mdi-file"></v-btn>
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
                <Pagination :paginate="notaSalida" v-model:page="page" />
            </template>
        </CardView>
    </TenantLayout>
</template>