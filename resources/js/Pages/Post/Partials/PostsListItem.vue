<script setup>
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    }
})
</script>

<template>
    <article class="flex max-w-xl flex-col items-start justify-between rounded-md bg-white py-2 px-3">
        <!--<img-->
        <!--    v-if="post.image"-->
        <!--    :src="post.image" alt=""-->
        <!--    class="size-10 rounded-full bg-gray-50"-->
        <!--/>-->
        <div class="flex items-center gap-x-4 text-xs">
            <time :datetime="post.created_at" class="text-gray-500">{{ new Date(post.created_at).toDateString() }}</time>
            <!--<a :href="post.category.href" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ post.category.title }}</a>-->
            <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1 font-medium text-gray-600 hover:bg-gray-100">{{ post.category.title }}</span>
        </div>
        <div class="group relative">
            <h3 class="text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                <Link :href="route('admin.posts.edit', post.id)">
                    <span class="absolute inset-0"/> {{ post.title }}
                </Link>
            </h3>
            <p class="mt-1 line-clamp-3 text-sm/6 text-gray-600">{{ post.description }}</p>
        </div>
        <div class="relative mt-1 flex items-center gap-x-4">
            <div class="text-sm/6">
                <p class="font-semibold text-gray-900">
                    <!--<a :href="post.author.href">-->
                    <span class="absolute inset-0"/>
                    {{ post.user.name }}
                    <!--</a>-->
                </p>
            </div>
        </div>
    </article>
</template>
