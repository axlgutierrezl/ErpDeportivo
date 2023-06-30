<script setup>
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from 'vue-toastification';
import { ref, watch } from 'vue';
import { Inertia } from "@inertiajs/inertia";
const emit = defineEmits(["addingCategoria", "update:show", "update:formulario"]);
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
const formCategoria = ref({
    id: 0,
    descripcion: '',
    processing: false,
    errors: {
        descripcion: ''
    }
});

watch($props, () => {
    if ($props.formulario) {
        formCategoria.value.id = $props.formulario.id;
        formCategoria.value.descripcion = $props.formulario.descripcion;
    }
});
async function GuardarCategoria() {
    try {
        formCategoria.value.processing = true;
        let url = formCategoria.value.id == 0 ? route('tenant.almacen.categorias.store') : route('tenant.almacen.categorias.update', { categoria: formCategoria.value.id });
        const method = formCategoria.value.id == 0 ? 'post' : 'put';
        const { data } = await axios[method](url, formCategoria.value);
        const { success, errors, message } = data;
        if (!success)
            throw { errors, message };
        toast.success(message, {
            timeout: $props.timeout
        });
        emit("addingCategoria");
        Limpiar();

    } catch (ex) {
        formCategoria.value.processing = false;
        if (ex.errors) {
            Errors(ex.errors);
        }
    }
}

function Errors(errors) {
    for (let v in formCategoria.value.errors) {
        if (errors.hasOwnProperty(v)) {
            formCategoria.value.errors[v] = errors[v][0];
        }

        if (!errors.hasOwnProperty(v)) {
            formCategoria.value.errors[v] = '';
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

    formCategoria.value = {
        id: 0,
        descripcion: '',
        processing: false,
        errors: {
            descripcion: ''
        }
    }
}

</script>
<template>
    <DialogFormModal v-model:show="show" @submitted="GuardarCategoria" @close="Limpiar"
        :processing="formCategoria.processing" :maxWidth="450">
        <template #title>
            <h3>
                {{ formCategoria.id == 0 ? 'Nueva categoria' : 'Editar categoria' }}
            </h3>
        </template>
        <template #content>
            <v-row>
                <v-col cols="12" md="12">
                    <v-text-field :error-messages="formCategoria.errors.descripcion" density="comfortable"
                        variant="outlined" label="Nombre" v-model="formCategoria.descripcion"></v-text-field>
                </v-col>
            </v-row>

        </template>
        <template #actions>
            <v-btn type="submit">
                {{ formCategoria.id == 0 ? 'Guardar' : 'Editar' }}
            </v-btn>
        </template>
    </DialogFormModal>
</template>