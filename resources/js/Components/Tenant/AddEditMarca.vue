<script setup>
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { useToast } from 'vue-toastification';
import { ref, watch } from "vue";
const emit = defineEmits(["addingMarca", "update:show", "update:formulario"]);
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

const toast = useToast();
const formMarca = ref({
    id: 0,
    nombre: '',
    procedencia: 'General',
    errors: {
        nombre: '',
    },
    processing: false
});
watch($props, () => {
    if ($props.formulario) {
        formMarca.value.id = $props.formulario.id;
        formMarca.value.nombre = $props.formulario.nombre;
    }
});

async function GuardarMarca() {
    try {
        formMarca.value.processing = true;
        let url = formMarca.value.id == 0 ? route('tenant.almacen.marcas.store') : route('tenant.almacen.marcas.update', { marca: formMarca.value.id });
        const method = formMarca.value.id == 0 ? 'post' : 'put';
        const { data } = await axios[method](url, formMarca.value);
        const { success, message, errors } = data;
        if (!success)
            throw { message, errors };
        toast.success(message, {
            timeout: $props.timeout
        });
        emit("addingMarca");
        Limpiar();
    } catch (ex) {
        formMarca.value.processing = false;
        if (ex.errors) {
            Errors(ex.errors);
        }
    }

}
function Errors(errors) {
    for (let v in formMarca.value.errors) {
        if (errors.hasOwnProperty(v)) {
            formMarca.value.errors[v] = errors[v][0];
        }

        if (!errors.hasOwnProperty(v)) {
            formMarca.value.errors[v] = '';
        }
    }

}

function Limpiar() {
    emit("update:show", false);
    emit("update:formulario", {
        id: 0,
        descripcion: '',
        ubicacion: ''
    });
    formMarca.value = {
        id: 0,
        nombre: '',
        procedencia: 'General',
        errors: {
            nombre: '',
        },
        processing: false
    }
}
</script>
<template>
    <DialogFormModal v-model:show="show" @submitted="GuardarMarca" @close="Limpiar" :processing="formMarca.processing"
        :maxWidth="450">
        <template #title>
            <h3>
                {{ formMarca.id == 0 ? 'Nueva marca' : 'Editar marca' }}
            </h3>
        </template>
        <template #content>
            <v-row>
                <v-col cols="12" md="12">
                    <v-text-field :error-messages="formMarca.errors.nombre" density="comfortable" variant="outlined"
                        label="Nombre" v-model="formMarca.nombre"></v-text-field>
                </v-col>
            </v-row>
        </template>
        <template #actions>
            <v-btn type="submit">
                {{ formMarca.id == 0 ? 'Guardar' : 'Editar' }}
            </v-btn>
        </template>
    </DialogFormModal>
</template>