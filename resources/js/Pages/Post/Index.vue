<script setup>
import { Head } from '@inertiajs/vue3';
import CommonLayout from "@/Layouts/CommonLayout.vue";
import PostsList from "@/Pages/Post/Partials/PostsList.vue";
</script>

<template>
    <Head title="Статьи" />

    <CommonLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Статьи
            </h2>
        </template>

        <div class="py-6">
            <PostsList/>
        </div>
    </CommonLayout>
</template>
