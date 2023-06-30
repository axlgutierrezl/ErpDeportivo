<script setup>
import { useToast } from 'vue-toastification';
import { useForm } from '@inertiajs/inertia-vue3';
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';


const emit = defineEmits(["addingAlmacen", "update:show", "update:formulario"]);
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
const formAlmacen = ref({
    id: 0,
    descripcion: '',
    ubicacion: '',
    errors: {
        descripcion: '',
        ubicacion: '',
    },
    processing: false
});
watch($props, () => {
    if ($props.formulario) {
        formAlmacen.value.id = $props.formulario.id;
        formAlmacen.value.descripcion = $props.formulario.descripcion;
        formAlmacen.value.ubicacion = $props.formulario.ubicacion;
    }
});

async function GuardarAlmacen() {

    try {
        formAlmacen.value.processing = true;
        let url = formAlmacen.value.id == 0 ? route('tenant.almacen.almacenes.store') : route('tenant.almacen.almacenes.update');
        const method = formAlmacen.value.id == 0 ? 'post' : 'put';
        const { data } = await axios[method](url, formAlmacen.value);
        const { success, errors, message } = data;
        if (!success)
            throw { errors, message };
        toast.success(message, { timeout: $props.timeout });
        emit("addingAlmacen");
        Limpiar();
    } catch (ex) {
        formAlmacen.value.processing = false;
        if (ex.errors) {
            Errors(ex.errors);
        }
    }
}
function Errors(errors) {
    for (let v in formAlmacen.value.errors) {
        if (errors.hasOwnProperty(v)) {
            formAlmacen.value.errors[v] = errors[v][0];
        }

        if (!errors.hasOwnProperty(v)) {
            formAlmacen.value.errors[v] = '';
        }
    }

}

function Limpiar() {
    // formAlmacen.reset();
    // formAlmacen.clearErrors();
    emit("update:show", false);
    emit("update:formulario", {
        id: 0,
        descripcion: '',
        ubicacion: ''
    });
    formAlmacen.value = {
        id: 0,
        descripcion: '',
        ubicacion: '',
        errors: {
            descripcion: '',
            ubicacion: '',
        },
        processing: false
    }
}

</script>
<template>
    <DialogFormModal v-model:show="show" @submitted="GuardarAlmacen" @close="Limpiar"
        :processing="formAlmacen.processing" :maxWidth="450">
        <template #title>
            <h3>
                {{ formAlmacen.id == 0 ? 'Nuevo almacen' : 'Editar almacen' }}
            </h3>
        </template>
        <template #content>
            <v-row>
                <v-col cols="12" md="12">
                    <v-text-field :error-messages="formAlmacen.errors.descripcion" density="comfortable"
                        variant="outlined" label="Nombre" v-model="formAlmacen.descripcion"></v-text-field>
                </v-col>
                <v-col cols="12" md="12">
                    <v-text-field :error-messages="formAlmacen.errors.ubicacion" density="comfortable"
                        variant="outlined" label="Ubicacion" v-model="formAlmacen.ubicacion"></v-text-field>
                </v-col>
            </v-row>

        </template>
        <template #actions>
            <v-btn type="submit">
                {{ formAlmacen.id == 0 ? 'Guardar' : 'Editar' }}
            </v-btn>
        </template>
    </DialogFormModal>
</template>