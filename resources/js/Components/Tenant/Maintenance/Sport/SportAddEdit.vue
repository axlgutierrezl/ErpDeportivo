<!-- CC1: CAMPOS -->
<template>
  <DialogFormModal
    :processing="form.processing"
    @submitted="save"
    v-model:show="show"
    :maxWidth="450"
    @close="reset"
  >
    <template #title>
      <h4>{{ sport.id == 0 ? "Agregar" : "Editar" }} Deporte</h4>
    </template>
    <template #content>
      <v-row>
        <v-col cols="12" md="12">
          <v-text-field
            :error-messages="form.errors.name"
            density="comfortable"
            variant="outlined"
            label="Nombre"
            v-model="form.name"
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="12">
          <v-text-field
            :error-messages="form.errors.description"
            density="comfortable"
            variant="outlined"
            label="Descripción"
            v-model="form.description"
          ></v-text-field>
        </v-col>
      </v-row>
    </template>
    <template #actions>
      <v-btn type="submit">
        {{ sport.id == 0 ? "Guardar" : "Editar" }}
      </v-btn>
    </template>
  </DialogFormModal>
</template>


<script setup>
import { useToast } from "vue-toastification";
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { ref, watch } from "vue";
const emit = defineEmits(["addUpdate", "update:show", "update:sport"]);
const $props = defineProps({
  show: {
    type: Boolean,
    required: false,
    default: false,
  },
  sport: {
    type: Object,
    default: () => null,
  },
  timeout: {
    type: Number,
    default: 1000,
  },
});
const toast = useToast();
const form = ref({
  id: 0,
  name: "",
  description: "",
  state: null,
  errors: {
    name: "",
    description: "",
  },
  processing: false,
});
watch($props, () => {
  if ($props.sport) {
    form.value.id = $props.sport.id;
    form.value.name = $props.sport.name;
    form.value.description = $props.sport.description;
  }
});

async function save() {
  try {
    form.value.processing = true;
    let url =
      form.value.id == 0
        ? route("tenant.maintenance.sports.store")
        : route("tenant.maintenance.sports.update");
    const method = form.value.id == 0 ? "post" : "put";
    const { data } = await axios[method](url, form.value);
    const { success, errors, message } = data;
    if (!success) throw { errors, message };
    toast.success(message, { timeout: $props.timeout });
    emit("addUpdate");
    reset();
  } catch (error) {
    form.value.processing = false;
    if (error.errors) {
      errors(error.errors);
    }
  }
}

function errors(errors) {
  for (let v in form.value.errors) {
    if (errors.hasOwnProperty(v)) {
      form.value.errors[v] = errors[v][0];
    }

    if (!errors.hasOwnProperty(v)) {
      form.value.errors[v] = "";
    }
  }
}

function reset() {
  emit("update:show", false);
  emit("update:sport", {
    id: 0,
    name: "",
    description: "",
    state: null,
  });
  form.value = {
    id: 0,
    name: "",
    description: "",
    state: null,
    errors: {
      name: "",
      description: "",
    },
    processing: false,
  };
}
</script>