<script setup>
import { computed } from 'vue';

// const emit = defineEmits(['update:checked']);

const props = defineProps({
    // checked: {
    //     type: [Array, Boolean],
    //     required: true,
    // },
    options: {
        type: Array,
        required: true,
    },
    value: {
        default: null,
    },
});

// const proxyChecked = computed({
//     get() {
//         return props.checked;
//     },
//
//     set(val) {
//         emit('update:checked', val);
//     },
// });
</script>

<template>
    <select
        :modelValue="value"
        class=""
    >
        <option
            v-for="option in options"
            :key="option.id"
            :value="option.id"
            :selected="option.id === value"
        >
            {{ option.title }}
        </option>
    </select>
</template>
