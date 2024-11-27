<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import CommonLayout from "@/Layouts/CommonLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import Select from "@/Components/Select.vue";

const props = defineProps({
    categories: {
        type: Array,
        default: () => ([]),
    },

    post: {
        type: Object,
        default: () => ({}),
    },

    isUpdate: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    title: props.post.title || '',
    description: props.post.description || '',
    content: props.post.content || '',
    category_id: props.post.category_id || '',
    // categories: $page.props.post.category_id || '',
});
</script>

<template>
    <form
        @submit.prevent="$page.props.isUpdate ? form.put(route('admin.posts.update', props.post.id)) : form.post(route('admin.posts.store'))"
        class="mt-6 space-y-6"
    >
        <div>
            <InputLabel for="title" value="Заголовок" />

            <TextInput
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div>
            <InputLabel for="description" value="Краткое описание статьи" />

            <TextInput
                id="description"
                type="text"
                class="mt-1 block w-full"
                v-model="form.description"
            />

            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div>
            <InputLabel for="text_content" value="Текст статьи" />

            <Textarea
                id="text_content"
                class="mt-1 block w-full"
                v-model="form.content"
            />

            <InputError class="mt-2" :message="form.errors.content" />
        </div>

        <div>
            <InputLabel for="category_id" value="Главная категория" />

            <Select
                id="category_id"
                class="mt-1 block w-full"
                v-model="form.category_id"
                :options="categories"
            />

            <InputError class="mt-2" :message="form.errors.category_id" />
        </div>

        <!--<div v-if="mustVerifyEmail && user.email_verified_at === null">-->
        <!--    <p class="mt-2 text-sm text-gray-800">-->
        <!--        Your email address is unverified.-->
        <!--        <Link-->
        <!--            :href="route('verification.send')"-->
        <!--            method="post"-->
        <!--            as="button"-->
        <!--            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"-->
        <!--        >-->
        <!--            Click here to re-send the verification email.-->
        <!--        </Link>-->
        <!--    </p>-->

        <!--    <div-->
        <!--        v-show="status === 'verification-link-sent'"-->
        <!--        class="mt-2 text-sm font-medium text-green-600"-->
        <!--    >-->
        <!--        A new verification link has been sent to your email address.-->
        <!--    </div>-->
        <!--</div>-->

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-gray-600"
                >
                    Готово.
                </p>
            </Transition>
        </div>
    </form>
</template>
