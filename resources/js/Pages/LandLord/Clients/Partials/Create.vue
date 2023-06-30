<script setup>

import LandLordLayout from '@/Layouts/LandLordLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';
const $props = defineProps(["dominio", "tablas"]);
const search = ref("");
const planes = ref([
    { nombre: 'Ilimitado', id: 1 }
]);

const perfiles = ref([
    { nombre: 'Administrador', id: 1 },
    { nombre: 'Listar documentos', id: 1 }
]);

let modulos = ref([]);
const tab = ref(null);
const loadingRuc = ref(false);
const planSelected = ref({ nombre: 'Ilimitado', id: 1 });
const perfilSelected = ref({ nombre: 'Administrador', id: 1 });
const formCliente = useForm({
    ruc: '',
    razon_social: '',
    email: '',
    password: '',
    plan: '',
    perfil: '',
    soap_envio: 'Sunat',
    soap_tipo: 'Demo',
    soap_password: '',
    certificado_pfx: '',
    mail_host: 'smtp.gmail.com',
    mail_port: '587',
    mail_username: '',
    mail_password: '',
    mail_encryption: 'tls',
    mail_mailer: 'smtp',
    domain: '',
    direccion_fiscal: '',
    ubigeo: '',
    modules:[],
    levels:[]
});

async function BuscarSunat() {
    try {
        loadingRuc.value = true;
        const { data } = await axios.get(route('apiRuc', { ruc: formCliente.ruc }));
        DataRuc(data);
    } catch (ex) {

    }
}
function DataRuc(response) {
    try {
        loadingRuc.value = false;
        const { data, success, message } = response;
        if (!success)
            throw message;
        const { direccion_completa, nombre_o_razon_social, ubigeo_sunat } = data;
        formCliente.direccion_fiscal = direccion_completa;
        formCliente.razon_social = nombre_o_razon_social;
        formCliente.ubigeo = ubigeo_sunat;
    } catch (ex) {
        alert(ex);
    }
}
function seleccionarModuloLevels(item,level) {
    if(item.childrens.length > 0){
        let checkedTotal=0;
        item.childrens.forEach((x) => {
            if(x.checked){
                checkedTotal++;
            }
        });

        if(checkedTotal == 0){
            item.checked = false;
        }else{
            item.checked = true;
        }
        
    }
}
function Guardar() {
    try {
        formCliente.modules = [];
        formCliente.levels = [];
        modulos.value.forEach(item=>{
            if(item.checked){
                formCliente.modules.push(item.id);

                if(item.childrens.length > 0){
                    item.childrens.forEach(level=>{
                        if(level.checked){
                            formCliente.levels.push(level.id);
                        }
                    });
                }
            }
        });
        
        formCliente.post(route('landlord.cliente.store'), {
            onSuccess: () => {
                console.log("ddd");
            }
        })
    } catch (ex) {
        console.log(ex);
    }
}
onMounted(() => {
    Inertia.reload({
        only: ['tablas'],
        onSuccess: () => {
            modulos.value = $props.tablas.modules;
        }
    })
});
</script>
<template>
    <LandLordLayout title="Clientes" titleBread="REGISTRAR NUEVO CLIENTE">
        <template #itemBreadCrumb>

        </template>

        <v-form @submit.prevent="Guardar">
            <v-card>
                <v-card-text>
                    <v-row>
                        <v-col cols="12" md="6" lg="6">
                            <v-card elevation="0" class="pa-0">
                                <v-card-text class="pa-0 pt-2">
                                    <v-row>
                                        <v-col cols="12" md="6" lg="5">
                                            <v-text-field v-model="formCliente.ruc" label="Ruc" density="comfortable"
                                                variant="outlined" @click:append-inner="BuscarSunat"
                                                append-inner-icon="mdi:mdi-card-search" :loading="loadingRuc">
                                                <template v-slot:loader>
                                                    <v-progress-linear :active="loadingRuc" absolute color="red" indeterminate>
                                                    </v-progress-linear>
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6" lg="7">
                                            <v-text-field v-model="formCliente.razon_social"
                                                label="Nombre de la empresa" density="comfortable" variant="outlined">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" md="12" lg="12">
                                            <v-text-field v-model="formCliente.direccion_fiscal"
                                                label="Dirección fiscal" density="comfortable" variant="outlined">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field label="Nombre de subdominio" density="comfortable"
                                                variant="outlined" v-model="formCliente.domain" :suffix="dominio">

                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field v-model="formCliente.email" label="Correo de acceso"
                                                density="comfortable" variant="outlined">

                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field v-model="formCliente.password" label="Contraseña"
                                                type="password" density="comfortable" variant="outlined"
                                                append-inner-icon="mdi:mdi-eye">

                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-select v-model="perfilSelected" :items="perfiles" item-title="nombre"
                                                item-value="id" label="Perfil" persistent-hint return-object
                                                variant="outlined" density="comfortable"></v-select>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" md="6" class="d-none">

                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="6" lg="6">
                            <v-card elevation="0" class="pa-0">
                                <v-tabs v-model="tab" fixed-tabs bg-color="grey-darken-3">
                                    <v-tab value="MODULOS">Modulos</v-tab>
                                    <v-tab value="ENTSISTEMA">Entronos del sistema</v-tab>
                                    <v-tab value="CCORREO">Configuración de correo</v-tab>
                                </v-tabs>

                                <v-card-text>
                                    <v-window v-model="tab">
                                        <v-window-item value="MODULOS">
                                            <v-row>
                                                <v-col cols="12" md="6" v-for="(item, index) in modulos" :key="index"
                                                    class="pa-1">
                                                    <v-list density="compact" class="pa-0">
                                                        <v-list-item v-if="item.childrens.length === 0"
                                                            :title="item.descripcion">
                                                            <template v-slot:prepend="{ isActive }">
                                                                <v-list-item-action start>
                                                                    <v-checkbox-btn :model-value="isActive"
                                                                        v-model="item.checked" density="compact">
                                                                    </v-checkbox-btn>
                                                                </v-list-item-action>
                                                            </template>
                                                        </v-list-item>
                                                        <v-list-group v-else>
                                                            <template v-slot:activator="{ props }">
                                                                <v-list-item v-bind="props" :title="item.descripcion">
                                                                    <template v-slot:prepend="{ isActive }">
                                                                        <v-list-item-action start>
                                                                            <v-checkbox-btn disabled :model-value="isActive"
                                                                                density="compact"
                                                                                v-model="item.checked"></v-checkbox-btn>
                                                                        </v-list-item-action>
                                                                    </template>
                                                                </v-list-item>
                                                            </template>
                                                            <v-list-item v-for="(level, num) in item.childrens"
                                                                :key="num" :title="level.descripcion">
                                                                <template v-slot:prepend="{ isActive }">
                                                                    <v-list-item-action start>
                                                                        <v-checkbox-btn :update:focused="seleccionarModuloLevels(item,level)" :model-value="isActive"
                                                                            density="compact" v-model="level.checked">
                                                                        </v-checkbox-btn>
                                                                    </v-list-item-action>
                                                                </template>
                                                            </v-list-item>
                                                        </v-list-group>
                                                    </v-list>
                                                </v-col>
                                            </v-row>
                                        </v-window-item>

                                        <v-window-item value="ENTSISTEMA">
                                            <v-container fluid>
                                                <v-row>
                                                    <v-col cols="12" md="6">
                                                        <v-select v-model="formCliente.soap_envio" label="SOAP Tipo"
                                                            variant="outlined" density="comfortable"
                                                            :items="['Sunat', 'Ose']">
                                                        </v-select>
                                                    </v-col>
                                                    <v-col cols="12" md="6">
                                                        <v-select v-model="formCliente.soap_tipo" label="SOAP Tipo"
                                                            variant="outlined" density="comfortable"
                                                            :items="['Demo', 'Produccion']">
                                                        </v-select>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field v-model="formCliente.soap_password"
                                                            variant="outlined" density="comfortable"
                                                            label="Contraseña certificado">
                                                        </v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="6">
                                                        <v-file-input variant="outlined" prepend-icon=""
                                                            density="comfortable" accept="image/*"
                                                            label="Certificado pfx" placeholder="selecciona un archivo">
                                                        </v-file-input>
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-window-item>

                                        <v-window-item value="CCORREO">
                                            <v-container fluid>
                                                <v-row>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field v-model="formCliente.mail_host"
                                                            density="comfortable" variant="outlined"
                                                            label="Dirección del host de correo"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field v-model="formCliente.mail_port"
                                                            density="comfortable" variant="outlined"
                                                            label="Puerto del host de correo"></v-text-field>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field density="comfortable"
                                                            v-model="formCliente.mail_encryption" variant="outlined"
                                                            label="Encriptación de correo"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field density="comfortable"
                                                            v-model="formCliente.mail_mailer" variant="outlined"
                                                            label="Servidor correo"></v-text-field>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field v-model="formCliente.mail_username"
                                                            density="comfortable" variant="outlined"
                                                            label="Nombre de usuario de correo"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="6">
                                                        <v-text-field v-model="formCliente.mail_password"
                                                            density="comfortable" variant="outlined"
                                                            label="Contraseña del usuario de correo"></v-text-field>
                                                    </v-col>

                                                </v-row>
                                            </v-container>
                                        </v-window-item>
                                    </v-window>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions class="justify-end">
                    <v-btn>Regresar</v-btn>
                    <v-btn type="submit">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </LandLordLayout>
</template>