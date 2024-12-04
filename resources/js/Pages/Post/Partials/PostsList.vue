<script setup>
import {Link} from '@inertiajs/vue3';
import {onMounted, onUnmounted, ref, toRefs} from "vue";
import Pagination from "@/Components/Pagination.vue";
import PostsListItem from "@/Pages/Post/Partials/PostsListItem.vue";

const props = defineProps({})

const urlParams = new URLSearchParams(window.location.search);

const page = ref(urlParams.get("page") || 1);

const posts = ref([])

const fetchList = () => {
    axios.get(route('api.posts.list', {page: page.value}))
        .then(response => {
            posts.value = response.data.data
        })
}

onMounted(() => {
    fetchList();
});

// onUnmounted(() => {
// });
</script>

<template>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <Pagination/>

        <div class="mx-auto my-6 grid max-w-2xl grid-cols-1 gap-6 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <PostsListItem
                v-for="post in posts"
                :key="post.id"
                :post="post"
            />
        </div>

        <Pagination/>
    </div>
</template>
