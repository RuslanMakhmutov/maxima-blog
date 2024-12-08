<script setup>
import CommentForm from "@/Pages/Post/Partials/Comment/CommentForm.vue";
import CommentsListItem from "@/Pages/Post/Partials/Comment/CommentsListItem.vue";
import {nextTick, ref} from "vue";

const props = defineProps({
    comments: {
        type: Array,
        default: () => ([]),
    },
    post: {
        type: Object,
        default: () => ({}),
    },
})

const reply_id = ref(null)

const insertStored = (comment) => {
    reply_id.value = null

    if (comment.parent_id) {
        console.log('comments', props.comments)
        // TODO неверный алгоритм поиска места для вставки. Возможно, лучше переделать список на иерархический.
        const insertAfterKey = props.comments.findLastIndex(el => (el.id === comment.parent_id) || (el.parent_id === comment.parent_id));

        if (insertAfterKey !== -1) {
            props.comments.splice(insertAfterKey + 1, 0, comment);
        } else {
            props.comments.push(comment);
        }
    } else {
        props.comments.push(comment);
    }

    nextTick(() => {
        document.getElementById(`comment-${comment.id}`).scrollIntoView({block: 'center', behavior: 'smooth'});
    })
}
</script>

<template>

    <section class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex flex-col">
                <div class="py-2 px-4 sm:py-3 sm:px-6 flex justify-between items-center">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Комментарии ({{ comments.length }})</h2>
                </div>

                <div>
                    <CommentsListItem
                        v-for="comment in comments"
                        :key="comment.id"
                        :comment="comment"
                        :post_id="post.id"
                        :reply_id="reply_id"
                        @reply="(id) => reply_id = id"
                        @stored="insertStored"
                    />
                </div>

                <CommentForm
                    v-if="!reply_id"
                    :post_id="post.id"
                    class="p-4 sm:p-6"
                    @stored="insertStored"
                />
            </div>
        </div>
    </section>
</template>
