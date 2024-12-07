<script setup>
import { Head } from '@inertiajs/vue3';
import CommonLayout from "@/Layouts/CommonLayout.vue";
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
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-4 sm:p-6 text-gray-900">
                        Тут пока ничего нет
                    </div>
                </div>
            </div>
        </div>
    </CommonLayout>
</template>
