<script setup>
const emit = defineEmits(['submitted', 'update:show', 'close']);
defineProps({
    show: {
        type: Boolean,
        required: true,
        default: () => false
    },
    maxWidth: {
        type: Number,
        default: () => 350
    },
    processing: {
        type: Boolean,
        default: false
    }
});
function cerraModal() {
    emit("update:show", false);
    emit("close");
}
</script>
<template>
    <v-dialog v-model="show" persistent :max-width="maxWidth">
        <v-form @submit.prevent="$emit('submitted')">
            <v-card>
                <v-card-title class="pa-5">
                    <slot name="title" />
                </v-card-title>
                <v-card-text>
                    <slot name="content" />
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click.prevent="cerraModal">
                        Cerrar
                    </v-btn>
                    <slot name="actions" />
                </v-card-actions>
                <v-overlay v-model="processing" contained class="align-center justify-center">
                    <v-progress-circular class="mx-auto" :size="50" color="primary" indeterminate></v-progress-circular>
                </v-overlay>
            </v-card>
        </v-form>
    </v-dialog>
</template>