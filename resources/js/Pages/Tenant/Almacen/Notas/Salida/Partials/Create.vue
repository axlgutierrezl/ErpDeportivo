<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import ProductoModal from '@/Components/Tenant/ProductoModal.vue';
import { ref } from 'vue';
const modalProducto = ref(false);
function ProductoSeleccionado(item){
    console.log(item);
}
</script>
<template>
    <TenantLayout title="Nota Ingreso" titleBread="Registro de notas de salida">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Nota Salida', 'Registrar']" class="pa-0"></v-breadcrumbs>
        </template>
        <v-form>
            <CardView>
                <template #title>
                    Nota de Salida
                </template>
                <template #subtitle>
                    Registrar datos de la Nota de Ingreso :
                </template>
                <template #content>
                    <v-row>
                        <v-col cols="12" md="3">
                            <v-text-field disabled label="Fecha" variant="outlined" density="comfortable" type="date">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" md="3">
                            <v-select variant="outlined" density="comfortable" return-object item-title="descripcion"
                                item-value="descripcion" label="Origen"></v-select>
                        </v-col>
                        <v-col cols="12" md="3">
                            <v-select variant="outlined" density="comfortable" return-object item-title="descripcion"
                                item-value="descripcion" label="Destino"></v-select>
                        </v-col>
                        <v-col cols="12" md="3">
                            <v-textarea variant="outlined" rows="2" density="comfortable" no-resize></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field @click:append="modalProducto = !modalProducto" label="Producto" density="comfortable" variant="outlined" append-icon="mdi:mdi-magnify"></v-text-field>
                        </v-col>
                    </v-row>
                </template>
            </CardView>
        </v-form>
        <ProductoModal v-model:show="modalProducto" @SelectedProduct="ProductoSeleccionado"/>
    </TenantLayout>
</template>