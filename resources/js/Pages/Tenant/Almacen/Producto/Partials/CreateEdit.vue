<script setup>
import TenantLayout from '@/Layouts/TenantLayout.vue';
import CardView from "@/Components/Tenant/CardView.vue";
import AddEditAlmacen from "@/Components/Tenant/AddEditAlmacen.vue";
import AddEditCategoria from "@/Components/Tenant/AddEditCategoria.vue";
import AddEditMarca from "@/Components/Tenant/AddEditMarca.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useToast } from 'vue-toastification';

const $props = defineProps(['getTables', 'flash', 'producto']);
const modalAlmacen = ref(false);
const modalCategoria = ref(false);
const modalMarca = ref(false);
const almacen = ref(null);
const unidadmedida = ref(null);
const categoria = ref(null);
const marca = ref(null);
const marcaData = ref([]);
const categoriaData = ref([]);
const almacenData = ref([]);
const unidadData = ref([]);
const alerta = ref(false);
const toast = useToast();
const formProducto = useForm({
    id: 0,
    almacen_id: null,
    categoria_id: null,
    marca_id: null,
    nombre: '',
    descripcion: '',
    codigo_barra: '',
    precio_venta: '',
    precio_compra: '',
    stock: '',
    stock_minimo: '',
    unidad_medida: null,
    estado: 'ACTIVO',
    registrando: false,
    tieneIgv: 0
});

function ListaGetTables() {
    Inertia.reload({
        only: ['getTables'],
        onSuccess: () => {
            almacenData.value = $props.getTables.almacenes;
            categoriaData.value = $props.getTables.categorias;
            marcaData.value = $props.getTables.marcas;
            unidadData.value = $props.getTables.unidadMedidas;

            if ($props.producto) {
                let um = unidadData.value.find(x => x.simbolo === $props.producto.unidad_medida);
                let umIndex = unidadData.value.findIndex(x => x.simbolo === $props.producto.unidad_medida);
                let primerItem = unidadData.value[0];

                unidadData.value.splice(0, 1, um);
                unidadData.value.splice(umIndex, 1, primerItem);

                let marc = marcaData.value.find(x => x.id === $props.producto.marca_id);
                let marcIndex = marcaData.value.findIndex(x => x.id === $props.producto.marca_id);
                let marc1Item = marcaData.value[0];
                marcaData.value.splice(0, 1, marc);
                marcaData.value.splice(marcIndex, 1, marc1Item);


                let almacen = almacenData.value.find(x => x.id === $props.producto.almacen_id);
                let almacenIndex = almacenData.value.findIndex(x => x.id === $props.producto.almacen_id);
                let alma1Item = almacenData.value[0];
                almacenData.value.splice(0, 1, almacen);
                almacenData.value.splice(almacenIndex, 1, alma1Item);

                let categoria = categoriaData.value.find(x => x.id === $props.producto.categoria_id);
                let categoriaIndex = categoriaData.value.findIndex(x => x.id === $props.producto.categoria_id);
                let categ1Item = categoriaData.value[0];
                categoriaData.value.splice(0, 1, categoria);
                categoriaData.value.splice(categoriaIndex, 1, categ1Item);
            }
        }
    })
}
function ListaAlmacenReload() {
    Inertia.reload({
        only: ['getTables'],
        onSuccess: () => {
            almacenData.value = $props.getTables.almacenes;
        },
        onError: () => {
            almacenData.value = $props.getTables.almacenes;
        }
    })
}
function ListaCategoriaReload() {
    Inertia.reload({
        only: ['getTables'],
        onSuccess: () => {
            categoriaData.value = $props.getTables.categorias;
        },
        onError: () => {
            categoriaData.value = $props.getTables.categorias;
        }
    })
}

function ListaMarcaReload() {
    console.log("reload marca");
    Inertia.reload({
        only: ['getTables'],
        onSuccess: () => {
            marcaData.value = $props.getTables.marcas;
        },
        onError: () => {
            marcaData.value = $props.getTables.marcas;
        }
    })
}
function GuardarProducto() {

    let url = formProducto.id == 0 ? route('tenant.almacen.productos.store') : route('tenant.almacen.productos.update', { producto: formProducto.id });
    let method = formProducto.id == 0 ? 'post' : 'put';
    formProducto[method](url, {
        errorBag: "newProducto",
        onError: () => {
            if (Object.entries(formProducto.errors).length > 0) {
                alerta.value = true;
            }
        },
        onSuccess: () => {
            if ($props.flash.success) {
                toast.success($props.flash.success);
                formProducto.reset();
                formProducto.clearErrors();
                formProducto.registrando = true;
                ListaGetTables();
            }

            if ($props.flash.error) {
                toast.error($props.flash.error);
            }
        }
    });
}

function newAlmacen() {
    modalAlmacen.value = true;
}
function newCategoria() {
    modalCategoria.value = true;
}
function newMarca() {
    modalMarca.value = true;
}
watch(almacenData, (data) => {
    let _almacen = $props.producto;
    almacen.value = _almacen ? data.find(x => x.id === _almacen.almacen_id) : data.length > 0 ? data[data.length - 1] : null;
});

watch(unidadData, (data) => {
    let um = $props.producto;
    unidadmedida.value = um ? data.find(x => x.simbolo === um.unidad_medida) : (data.length > 0 ? data[0] : null);
});

watch(categoriaData, (data) => {
    let categ = $props.producto;
    categoria.value = categ ? data.find(x => x.id === categ.categoria_id) : (data.length > 0 ? data[0] : null);
});

watch(marcaData, (data) => {
    let marc = $props.producto;
    marca.value = marc ? data.find(x => x.id === marc.marca_id) : (data.length > 0 ? data[0] : null);
});

watch(almacen, (data) => {
    formProducto.almacen_id = data ? data.id : null;
    if (data) {
        delete formProducto.errors.almacen_id;
    }
});

watch(unidadmedida, (data) => {
    formProducto.unidad_medida = data ? data.simbolo : null;
    if (data) {
        delete formProducto.errors.unidad_medida;
    }
});

watch(categoria, (data) => {
    formProducto.categoria_id = data ? data.id : null;
    if (data) {
        delete formProducto.errors.categoria_id;
    }
});

watch(marca, (data) => {
    formProducto.marca_id = data ? data.id : null;
    if (data) {
        delete formProducto.errors.marca_id;
    }
});

watch(formProducto, (data) => {

    for (let key in data) {
        if (key != "errors") {
            for (let x in formProducto.errors) {
                if (key != "categoria_id" && key != "almacen_id" && key != "marca_id" && key != "unidad_medida" && x == key) {
                    if (data[key] != "") {
                        if (!alerta.value) {
                            delete formProducto.errors[x];
                        }
                    }
                }
            }
        }
    }
    alerta.value = false;
}, { deep: true });


onMounted(() => {
    ListaGetTables();
    if ($props.producto) {
        formProducto.nombre = $props.producto.nombre;
        formProducto.precio_compra = $props.producto.precio_compra;
        formProducto.precio_venta = $props.producto.precio_venta;
        formProducto.stock = $props.producto.stock;
        formProducto.stock_minimo = $props.producto.stock_minimo;
        formProducto.codigo_barra = $props.producto.codigo_barra;
        formProducto.id = $props.producto.id;
        formProducto.descripcion = $props.producto.descripcion;
        formProducto.tieneIgv = $props.producto.tiene_igv;
    }

});

</script>
<template>
    <TenantLayout :title="formProducto.id == 0 ? 'Crear' : 'Editar'"
        :titleBread="formProducto.id == 0 ? 'Registrar productos' : 'Editar producto'">
        <template #itemBreadCrumb>
            <v-breadcrumbs :items="['Almacen', 'Productos', formProducto.id == 0 ? 'Registro' : 'Editar']" class="pa-0">
            </v-breadcrumbs>
        </template>
        <v-form @submit.prevent="GuardarProducto">
            <CardView>
                <template #title>
                    <v-checkbox hide-details v-model="formProducto.registrando" label="Seguir registrando"></v-checkbox>
                </template>
                <template #content>
                    <v-row>
                        <v-col cols="12" md="7">
                            <v-row>
                                <v-col cols="12" md="12">
                                    <v-text-field :error-messages="formProducto.errors.nombre"
                                        v-model="formProducto.nombre" label="Nombre" variant="outlined"
                                        density="compact"></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="12">
                                    <v-textarea rows="2" v-model="formProducto.descripcion" density="compact"
                                        variant="outlined" label="Descripción">
                                    </v-textarea>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-combobox :error-messages="formProducto.errors.almacen_id" v-model="almacen"
                                        clearable :items="almacenData" return-object item-value="id"
                                        item-title="descripcion" density="compact" variant="outlined" label="Almacén"
                                        append-icon="mdi:mdi-plus" @click:append="newAlmacen">
                                    </v-combobox>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-combobox v-model="unidadmedida"
                                        :error-messages="formProducto.errors.unidad_medida" clearable
                                        :items="unidadData" return-object item-value="simbolo" item-title="descripcion"
                                        density="compact" variant="outlined" label="Unidad de medida"></v-combobox>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-combobox v-model="categoria" :error-messages="formProducto.errors.categoria_id"
                                        clearable :items="categoriaData" return-object item-value="id"
                                        item-title="descripcion" density="compact" variant="outlined" label="Categoria"
                                        append-icon="mdi:mdi-plus" @click:append="newCategoria">

                                    </v-combobox>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-combobox :error-messages="formProducto.errors.marca_id" v-model="marca" clearable
                                        :items="marcaData" return-object item-value="id" item-title="nombre"
                                        density="compact" variant="outlined" label="Marca" append-icon="mdi:mdi-plus"
                                        @click:append="newMarca">
                                    </v-combobox>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col cols="12" md="5">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field :error-messages="formProducto.errors.precio_venta"
                                        v-model="formProducto.precio_venta" label="Precio Venta" variant="outlined"
                                        density="compact"></v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field :error-messages="formProducto.errors.precio_compra"
                                        v-model="formProducto.precio_compra" label="Precio Compra" variant="outlined"
                                        density="compact"></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field :disabled="formProducto.id > 0 ? true : false"
                                        :error-messages="formProducto.errors.stock" v-model="formProducto.stock"
                                        label="Stock" variant="outlined" density="compact">
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field :error-messages="formProducto.errors.stock_minimo"
                                        v-model="formProducto.stock_minimo" label="Stock minimo" variant="outlined"
                                        density="compact"></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field :error-messages="formProducto.errors.codigo_barra"
                                        v-model="formProducto.codigo_barra" label="Codigo de barra" variant="outlined"
                                        density="compact"></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-radio-group v-model="formProducto.tieneIgv" inline title="Tiene IGV"
                                        label="¿Tiene IGV?">
                                        <v-radio label="SI" :value="1" class="mr-2"></v-radio>
                                        <v-radio label="NO" :value="0"></v-radio>
                                    </v-radio-group>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </template>
                <template #actions>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="$inertia.visit(route('tenant.almacen.productos.index'))">Regresar</v-btn>
                        <v-btn type="submit">
                            {{ formProducto.id == 0 ? 'Guardar' : 'Actualizar' }}
                        </v-btn>
                    </v-card-actions>
                </template>
            </CardView>
        </v-form>
    </TenantLayout>
    <AddEditAlmacen v-if="modalAlmacen" v-model:show="modalAlmacen" @addingAlmacen="ListaAlmacenReload" />
    <AddEditCategoria v-if="modalCategoria" v-model:show="modalCategoria" @addingCategoria="ListaCategoriaReload" />
    <AddEditMarca v-if="modalMarca" v-model:show="modalMarca" @addingMarca="ListaMarcaReload" />
</template>