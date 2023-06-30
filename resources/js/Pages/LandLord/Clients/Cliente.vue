<script setup>
import LandLordLayout from '@/Layouts/LandLordLayout.vue';
import { ref, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const $props = defineProps(['clientes']);
const search = ref("");
const dataClientes = ref([]);
onMounted(() => {
    Inertia.reload({
        only: ['clientes'],
        onSuccess: () => {
            dataClientes.value = $props.clientes;
        }
    })
});
</script>
<template>
    <LandLordLayout title="Clientes" titleBread="Clientes">
        <template #itemBreadCrumb>

        </template>
        <v-card>
            <v-card-title class="pt-5 pb-2">
                <v-row>
                    <v-col cols="12" md="3">
                        <v-text-field v-model="search" hide-details label="Buscar" density="compact"
                            variant="underlined">
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="9">
                        <v-btn color="teal" class="float-right"
                            @click="$inertia.visit(route('landlord.cliente.create'))">
                            <v-icon icon="mdi:mdi-plus"></v-icon>
                            Registrar
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-title>
            <v-card-text>
                <v-table>
                    <thead class="text-uppercase text-center">
                        <tr>
                            <th>Fecha Registro</th>
                            <th>Dominio</th>
                            <th>Empresa</th>
                            <th>Ruc</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Restaurar Contraseña</th>
                            <th>Entorno</th>
                            <th>Estado</th>
                            <th>Fecha Pago</th>
                            <th>Pago</th>
                            <th>Dias faltantes</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataClientes" :key="index">
                            <td>{{ item.fecha_creacion }}</td>
                            <td>
                                <a :href="'//' + item.tenant.domain" target="_blank">{{ item.tenant.domain }}</a>
                            </td>
                            <td>
                                <div style="width:200px; white-space:nowrap;overflow: hidden;text-overflow: ellipsis;">
                                    {{ item.razon_social }}
                                </div>
                            </td>
                            <td class="text-center">{{ item.ruc }}</td>
                            <td class="text-center">{{ item.email }}</td>
                            <td class="text-center">{{ item.password }}</td>
                            <td class="text-center">
                                <v-btn size="x-small" color="blue" icon="mdi:mdi-camera-flip"></v-btn>
                            </td>
                            <td class="text-center">
                                <v-chip variant="outlined"
                                    :color="item.soap_tipo == 'Demo' ? 'orange-darken-1' : 'green-darken-1'">
                                    {{ item.soap_tipo }}
                                </v-chip>
                            </td>
                            <td class="text-center">{{ item.estado }}</td>
                            <td class="text-center">{{ item.pago_fecha }}</td>
                            <td class="text-center">
                                <v-btn color="orange-darken-1" size="small">
                                    Pagos
                                </v-btn>
                            </td>
                            <td class="text-center">{{ item.dias_faltantes }}</td>
                            <td>
                                <v-btn size="small" color="success">Editar</v-btn>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-text>
        </v-card>
    </LandLordLayout>
</template>