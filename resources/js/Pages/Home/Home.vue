<script setup>
import { Head } from '@inertiajs/vue3';
import CommonLayout from "@/Layouts/CommonLayout.vue";
import Pollutions from "@/Pages/Home/Partials/Pollutions.vue";

defineProps({
    air: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Новостной блог" />

    <CommonLayout>
        <template #header>
            <h2
                class="text-lg font-semibold leading-tight text-gray-800"
            >
                Главная
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Pollutions
                    v-if="air"
                    :air="air"
                />
            </div>
        </div>
    </CommonLayout>
</template>
