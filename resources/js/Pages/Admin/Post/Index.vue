<script setup>
import {Head} from '@inertiajs/vue3';
import CommonLayout from "@/Layouts/CommonLayout.vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    posts: {
        type: Object,
        default: () => ({
            data: [],
            links: {},
            meta: {},
        }),
    },
});
</script>

<template>
    <Head title="Статьи" />

    <CommonLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Управление статьями
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                <table class="border-collapse border border-gray-300 w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">ID</th>
                            <th class="border border-gray-300 p-2">Заголовок</th>
                            <th class="border border-gray-300 p-2">Дата</th>
                            <th class="border border-gray-300 p-2">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts.data" :key="post.id">
                            <td class="border border-gray-300 p-2 text-right">{{ post.id }}</td>
                            <td class="border border-gray-300 p-2">
                                {{ post.title }}
                            </td>
                            <td class="border border-gray-300 p-2">{{ new Date(post.created_at).toLocaleString() }}</td>
                            <td class="border border-gray-300 p-2">
                                <!--<a :href="route('post.edit', post.id)">Редактировать</a>-->
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <NavLink
                        :href="route('admin.posts.add')"
                        :only="['categories']"
                        class="py-1 px-2 text-white hover:text-white bg-blue-400 hover:bg-blue-500"
                    >
                        Добавить статью
                    </NavLink>
                </div>

                <nav class="p-2 bg-white">
                    <NavLink
                        :href="posts.links.first ? posts.links.first : ''"
                        :only="['posts']"
                        class="py-1 px-2 border border-gray-300"
                        :class="{'pointer-events-none opacity-50': !posts.links.first || posts.meta.current_page === 1}"
                    >
                        Первая
                    </NavLink>
                    <NavLink
                        :href="posts.links.prev ? posts.links.prev : ''"
                        :only="['posts']"
                        class="py-1 px-2 border border-gray"
                        :class="{'pointer-events-none opacity-50': !posts.links.prev}"
                    >
                        Предыдущая
                    </NavLink>
                    <NavLink
                        :href="posts.links.next ? posts.links.next : ''"
                        :only="['posts']"
                        class="py-1 px-2 border border-gray-300"
                        :class="{'pointer-events-none opacity-50': !posts.links.next}"
                    >
                        Следующая
                    </NavLink>
                    <NavLink
                        :href="posts.links.last ? posts.links.last : ''"
                        :only="['posts']"
                        class="py-1 px-2 border border-gray-300"
                        :class="{'pointer-events-none opacity-50': !posts.links.last || posts.meta.current_page === posts.meta.last_page}"
                    >
                        Последняя
                    </NavLink>
                </nav>
            </div>
        </div>
    </CommonLayout>
</template>
