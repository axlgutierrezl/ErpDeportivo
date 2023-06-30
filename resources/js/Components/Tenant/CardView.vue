<script setup>
</script>
<template>
    <v-card >
        <v-card-title>
            <slot name="title" />
        </v-card-title>
        <v-card-subtitle>
            <slot name="subtitle" />
        </v-card-subtitle>
        <v-card-text>
            <slot name="content" />
        </v-card-text>
        <slot name="actions" />
    </v-card>
</template>