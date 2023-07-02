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
      <h4>{{ field.id == 0 ? "Agregar" : "Editar" }} Campo</h4>
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
          <v-row>
            <v-col cols="12" md="12">
              <v-combobox
                clearable
                :error-messages="form.errors.sport_id"
                :items="sports"
                return-object="false"
                item-value="id"
                item-title="name"
                density="compact"
                variant="outlined"
                label="Deporte"
                v-model="sport"
              >
              </v-combobox>
            </v-col>
          </v-row>
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
        {{ field.id == 0 ? "Guardar" : "Editar" }}
      </v-btn>
    </template>
  </DialogFormModal>
</template>


<script setup>
import { useToast } from "vue-toastification";
import DialogFormModal from "@/Components/Tenant/DialogFormModal.vue";
import { onMounted, ref, watch } from "vue";
const emit = defineEmits(["addUpdate", "update:show", "update:field"]);
const $props = defineProps({
  show: {
    type: Boolean,
    required: false,
    default: false,
  },
  field: {
    type: Object,
    default: () => null,
  },
  timeout: {
    type: Number,
    default: 1000,
  },
});
const toast = useToast();
const sports = ref([]);
const form = ref({
  id: 0,
  name: "",
  description: "",
  sport_id: null,
  state: null,
  errors: {
    name: "",
    description: "",
    sport_id: "",
  },
  processing: false,
});

onMounted(() => {
  listSports();
});

watch($props, () => {
  if ($props.field) {
    form.value.id = $props.field.id;
    form.value.name = $props.field.name;
    form.value.sport_id = $props.field.sport_id;
    form.value.sport = $props.field.sport;
    form.value.description = $props.field.description;
    sport.value = $props.field.sport;

  }
});

/* Select sport */
const sport = ref(null);
watch(sport,(data)=>{
    if(data){
        form.value.sport_id = data.id;
    }
});
/* Select sport */

async function save() {
  try {
    form.value.processing = true;
    let url =
      form.value.id == 0
        ? route("tenant.configuration.fields.store")
        : route("tenant.configuration.fields.update");
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

async function listSports() {
  try {
    const { data } = await axios.get(
      route("tenant.maintenance.sports.active"),
      {}
    );
    sports.value = data;
  } catch (ex) {
    console.log(ex);
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
  emit("update:field", {
    id: 0,
    name: "",
    description: "",
    sport: "",
    sport_id: null,
    state: null,
  });
  form.value = {
    id: 0,
    name: "",
    description: "",
    sport: "",
    sport_id: null,
    state: null,
    errors: {
      name: "",
      description: "",
      sport_id: "",
    },
    processing: false,
  };
}
</script>