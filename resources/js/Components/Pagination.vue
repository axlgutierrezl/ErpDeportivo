<script setup>
import { watch, ref } from "vue";

const $props = defineProps(['paginate', 'page']);
const emit = defineEmits(["update:page"]);
const currentPage = ref(0);
watch(currentPage, (data) => {
    emit("update:page", data);
});
watch($props,(data)=>{
    currentPage.value = data.paginate.current_page;
});

</script>
<template>
    <v-row justify="center" v-if="paginate">
        <v-col cols="8">
            <v-container class="max-width">
                <v-pagination rounded="circle" active-color="success"  :total-visible="7" v-model="paginate.current_page" class="my-4" :length="paginate.last_page"
                    v-model:modelValue="currentPage"></v-pagination>
            </v-container>
        </v-col>
    </v-row>
</template>