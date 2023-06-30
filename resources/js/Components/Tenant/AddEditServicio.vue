<script setup>
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { ref, watch } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
const toast = useToast();
const emit = defineEmits(["addingServicio", "update:show", "update:formulario"]);
const $props = defineProps({
    show: {
        type: Boolean,
        required: false,
        default: false
    },
    formulario: {
        type: Object,
        default: () => null
    },
    timeout: {
        type: Number,
        default: 1000
    }
});

const formServicio = ref({
    id: 0,
    nombre: '',
    precio: '',
    estado_alquiler: null,
    processing: false,
    errors: {
        nombre: '',
        precio: '',
        estado_alquiler: '',
    }
});

async function GuardarServicio() {
    try {
        formServicio.value.processing = true;
        let url = formServicio.value.id == 0 ? route('tenant.almacen.servicios.store') : route('tenant.almacen.servicios.update', { servicio: formServicio.value.id });
        const method = formServicio.value.id == 0 ? 'post' : 'put';
        const { data } = await axios[method](url, formServicio.value);
        const { errors, success, message } = data;
        if (!success)
            throw { message, errors };
        toast.success(message, { timeout: 1000 });
        emit("addingServicio");
        Limpiar();
    } catch (ex) {
        formServicio.value.processing = false;
        if (ex.errors) {
            Errors(ex.errors);
        }
    }
}
watch($props, (data) => {
    if (data.formulario) {
        formServicio.value.id = data.formulario.id;
        formServicio.value.nombre = data.formulario.nombre;
        formServicio.value.precio = data.formulario.precio;
        formServicio.value.estado_alquiler = data.formulario.estado_alquiler;
    }
});
function Errors(errors) {
    for (let v in formServicio.value.errors) {
        if (errors.hasOwnProperty(v)) {
            formServicio.value.errors[v] = errors[v][0];
        }

        if (!errors.hasOwnProperty(v)) {
            formServicio.value.errors[v] = '';
        }
    }

}
function Limpiar() {
    emit("update:show", false);
    formServicio.value = {
        id: 0,
        nombre: '',
        precio: '',
        estado_alquiler: '',
        processing: false,
        errors: {
            nombre: '',
            precio: '',
            estado_alquiler: '',
        }
    }
    emit("update:formulario", null);
}
</script>
<template>
    <DialogFormModal v-model:show="show" @submitted="GuardarServicio" @close="Limpiar"
        :processing="formServicio.processing" :maxWidth="450">
        <template #title>
            {{ formServicio.id == 0 ? 'Nuevo servicio' : 'Editar servicio' }}
        </template>
        <template #content>
            <v-row>
                <v-col cols="12" md="12">
                    <v-text-field label="Nombre" :error-messages="formServicio.errors.nombre" variant="outlined"
                        density="comfortable" v-model="formServicio.nombre">
                    </v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6">
                    <v-text-field label="Precio" :error-messages="formServicio.errors.precio" variant="outlined"
                        density="comfortable" v-model="formServicio.precio">
                    </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-select :error-messages="formServicio.errors.estado_alquiler" label="Alquiler"
                        :items="['CAMPO NOCHE', 'CAMPO DIA', 'ACADEMIA']" variant="outlined" density="comfortable"
                        v-model="formServicio.estado_alquiler"></v-select>
                </v-col>
            </v-row>
        </template>
        <template #actions>
            <v-btn type="submit">
                {{ formServicio.id == 0 ? 'Guardar' : 'Editar' }}
            </v-btn>
        </template>
    </DialogFormModal>
</template>