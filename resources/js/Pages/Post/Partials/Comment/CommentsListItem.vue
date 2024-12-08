<script setup>
import {Link} from '@inertiajs/vue3';
import {computed} from "vue";
import CommentForm from "@/Pages/Post/Partials/Comment/CommentForm.vue";
const props = defineProps({
    comment: {
        type: Object,
        default: () => ({}),
    },
    post_id: {
        type: Number,
        required: true,
    },
    reply_id: {
        type: Number,
        default: null,
    },
})

const classes = computed(() => {
    let classes = [];

    switch (props.comment.level) {
        case 2:
            classes.push('ml-4 sm:ml-8');
            break;
        case 3:
            classes.push('ml-8 sm:ml-16');
            break;
        case 4:
            classes.push('ml-12 sm:ml-24');
            break;
        case 5:
            classes.push('ml-16 sm:ml-32');
            break;
    }

    return classes.join(' ')
})

const emit = defineEmits(['stored', 'reply'])

const handleStored = (comment) => {
    console.log('handle stored', comment)

    emit('stored', comment)
}

const handleReplyClick = (id) => {
    console.log('handle reply click', id)

    emit('reply', id)
}
</script>

<template>
    <article
        :id="`comment-${comment.id}`"
        class="p-4 sm:p-6 mb-3 last:mb-0 text-base bg-white border-t last:border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900"
        :class="classes"
    >
        <footer class="flex justify-between items-center mb-2">
            <a
                :href="`#comment-${comment.id}`"
                class="flex items-center"
            >
                <!--<span class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">root_id:{{ comment.root_id }}</span>-->
                <!--<span class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">parent_id:{{ comment.parent_id || 'null' }}</span>-->
                <!--<span class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">id:{{ comment.id }}</span>-->
                <span class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ comment.user.name }}</span>
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    <time :datetime="comment.created_at">
                        {{ new Date(comment.created_at).toLocaleDateString() }} {{ new Date(comment.created_at).toLocaleTimeString() }}
                    </time>
                </span>
            </a>
            <!--<button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"-->
            <!--        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"-->
            <!--        type="button">-->
            <!--    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">-->
            <!--        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>-->
            <!--    </svg>-->
            <!--    <span class="sr-only">Comment settings</span>-->
            <!--</button>-->
            <!--&lt;!&ndash; Dropdown menu &ndash;&gt;-->
            <!--<div id="dropdownComment1"-->
            <!--     class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">-->
            <!--    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"-->
            <!--        aria-labelledby="dropdownMenuIconHorizontalButton">-->
            <!--        <li>-->
            <!--            <a href="#"-->
            <!--               class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <a href="#"-->
            <!--               class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <a href="#"-->
            <!--               class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</div>-->
        </footer>

        <p
            class="text-gray-500 dark:text-gray-400"
            v-for="(p, key) in comment.content.split(/[\r\n]+/)"
            :key="key"
        >{{ p }}</p>

        <CommentForm
            v-if="reply_id === comment.id"
            :post_id="post_id"
            :parent_id="comment.id"
            @stored="handleStored"
            class="mt-6"
        />
        <div
            v-else
            class="flex items-center mt-4 space-x-4"
        >
            <button
                @click="handleReplyClick(comment.id)"
                type="button"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium"
            >
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                Ответить
            </button>
        </div>
    </article>
</template>
