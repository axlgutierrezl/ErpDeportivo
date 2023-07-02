<!-- CC1: CAMPOS -->
<template>
  <TenantLayout title="Deportes" titleBread="Listado de deportes">
    <template #itemBreadCrumb>
      <v-breadcrumbs
        :items="['Mantenimiento', 'Deportes', 'Lista']"
        class="pa-0"
      ></v-breadcrumbs>
    </template>
    <CardView>
      <template #title>
        <v-row class="pt-3">
          <v-col cols="12" md="1">
            <v-select
              v-model="size"
              hide-details
              label="Registros"
              class="text-center"
              :items="[5, 10, 15, 25, 50, 100]"
              density="compact"
              variant="outlined"
            ></v-select>
          </v-col>
          <v-col cols="12" md="5">
            <v-text-field
              v-model="search"
              hide-details
              variant="outlined"
              density="compact"
              label="Buscar"
              append-inner-icon="mdi:mdi-magnify"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-btn
              class="float-right"
              color="teal-darken-2"
              @click.prevent="openModal('ADD')"
            >
              <v-icon icon="mdi:mdi-plus" class="mr-1"></v-icon>
              Agregar
            </v-btn>
          </v-col>
        </v-row>
      </template>
      <template #content>
        <v-table density="comfortable" hover fixed-header>
          <thead class="text-uppercase bg-thead-primary">
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Descripción</th>
              <th class="text-center">Fecha creación</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="data.length > 0">
              <tr
                v-for="(item, index) in data"
                :key="index"
                :class="{ 'class-row-delete': item.state == 0 }"
              >
                <td class="text-center">{{ item.id }}</td>
                <td class="text-center">{{ item.name }}</td>
                <td class="text-center">{{ item.description }}</td>
                <td class="text-center">
                  {{ moment(item.created_at).format("DD/MM/YYYY HH:mm:ss") }}
                </td>
                <td v-if="item.state === '1'" class="text-center">Activo</td>
                <td v-else-if="item.state === '0'" class="text-center">
                  Inactivo
                </td>
                <td class="text-center">
                  <v-btn
                    prepend-icon="mdi:mdi-pencil"
                    @click="openModal('EDIT', item)"
                    color="success"
                    size="small"
                    class="mr-1 mt-1"
                  >
                    <template v-slot:prepend>
                      <v-icon color=""></v-icon>
                    </template>
                    EDITAR
                  </v-btn>
                  <v-btn
                    prepend-icon="mdi:mdi-delete"
                    @click="openModal('DELETE', item)"
                    color="red"
                    size="small"
                    class="mr-l mt-1"
                  >
                    <template v-slot:prepend>
                      <v-icon color=""></v-icon>
                    </template>
                    ELIMIMAR
                  </v-btn>
                </td>
              </tr>
            </template>
            <template v-else>
              <tr>
                <td colspan="6" class="text-center">
                  <strong>No hay registros</strong>
                </td>
              </tr>
            </template>
          </tbody>
        </v-table>
        <Pagination v-if="sports" :paginate="sports" v-model:page="page" />
      </template>
    </CardView>
    <SportAddEdit v-model:show="modal" @addUpdate="list" v-model:sport="form" />
    <SportDelete
      v-model:show="modalDelete"
      @delete="list"
      v-model:sport="form"
    />
  </TenantLayout>
</template>

<script setup>
import TenantLayout from "@/Layouts/TenantLayout.vue";
import CardView from "@/Components/Tenant/CardView.vue";
import SportDelete from "@/Components/Tenant/Maintenance/Sport/SportDelete.vue";
import SportAddEdit from "@/Components/Tenant/Maintenance/Sport/SportAddEdit.vue";
import Pagination from "@/Components/Pagination.vue";
import { onMounted, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";

const modal = ref(false);
const modalDelete = ref(false);
const $props = defineProps(["flash", "sports", "filters"]);
const data = ref([]);

// DataTable
const page = ref(1);
const size = ref();
const search = ref(null);

const form = ref({
  id: 0,
  name: "",
  description: "",
  state: null,
});

function list() {
  Inertia.reload({
    only: ["sports"],
    preserveState: true,
    onSuccess: () => {
      data.value = $props.sports.data;
      if ($props.filters.size) {
        size.value = Number($props.filters.size);
      }

      if ($props.filters.search) {
        search.value = $props.filters.search;
      }

      if ($props.filters.page) {
        page.value = Number($props.filters.page);
      }

      if ($props.flash.success) {
        toast.success($props.flash.success);
      }
      if ($props.flash.error) {
        toast.error($props.flash.error);
      }
    },
    onError: () => {
      console.log("errors");
    },
  });
}

watch(page, (data) => {
  listPageSearching(data);
});

watch(search, (data) => {
  page.value = 1;
  setTimeout(() => {
    listPageSearching();
  }, 500);
});

watch(size, () => {
  page.value = 1;
  listPageSearching();
});

function listPageSearching() {
  Inertia.get(
    route("tenant.maintenance.sports.index"),
    {
      page: page.value,
      search: search.value,
      size: size.value,
    },
    {
      only: ["sports"],
      preserveState: true,
      replace: true,
      onSuccess: () => {
        data.value = $props.sports.data;
      },
    }
  );
}

onMounted(() => {
  list();
});

function openModal(action, data = {}) {
  switch (action) {
    case "ADD": {
      modal.value = true;
      break;
    }
    case "EDIT": {
      modal.value = true;
      form.value.id = data.id;
      form.value.name = data.name;
      form.value.description = data.description;
      form.value.state = data.state;
      break;
    }
    case "DELETE": {
      modalDelete.value = true;
      form.value.id = data.id;
      form.value.name = data.name;
      break;
    }
  }
}
</script>
