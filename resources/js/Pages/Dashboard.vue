<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { TextInput, Button } from "custom-mbd-components";
import { Message, User } from "@/types/index";
import { ref, toRefs } from "vue";
import { watch } from "vue";
import { watchEffect } from "vue";
const props = defineProps<{
    currentUser: User;
    messages: Message[];
}>();
const { currentUser, messages: messageProp } = toRefs(props);
const messages = ref(messageProp);
watchEffect(() => (messages.value = messageProp.value));
const messageForm = useForm<{ text: string }>({
    text: "",
});
function addMessage() {
    messageForm.post(route("storeMessage"), { preserveScroll: true });
    messages.value.push({
        text: messageForm.text,
        id: -1,
        sent: new Date(),
        type: "user",
        chat: messages.value[0]?.chat,
    });
    messageForm.text = "";
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div
            class="fixed-bottom d-flex justify-content-center align-items-center bg-white"
        >
            <TextInput
                v-model="messageForm.text"
                style="width: 60vw"
                placeholder="Schreiben Sie eine Nachricht"
                class="bg-white mb-4"
            ></TextInput>
            <Button class="mt-3 ms-2 btn btn-primary mb-4" @click="addMessage()"
                >Abschicken</Button
            >
        </div>
        <div class="flex-column" style="width: 66vw; padding-bottom: 4rem">
            <template v-for="message in messages">
                <div
                    class="d-flex mb-3 w-100"
                    :class="{ 'justify-content-end': message.type === 'user' }"
                >
                    <div
                        v-if="message.type === 'assistant'"
                        class="d-flex justify-content-center align-items-center me-4"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="currentColor"
                            class="bi bi-robot"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z"
                            />
                            <path
                                d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z"
                            />
                        </svg>
                    </div>
                    <div
                        class="speech"
                        :class="message.type === 'user' ? 'right' : 'left'"
                    >
                        {{ message.text }}
                    </div>
                    <div
                        v-if="message.type === 'user'"
                        class="d-flex justify-content-center align-items-center ms-4"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="currentColor"
                            class="bi bi-person-circle"
                            viewBox="0 0 16 16"
                        >
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path
                                fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"
                            />
                        </svg>
                    </div>
                </div>
            </template>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.speech {
    font-size: 1.1em;
    color: #fff;
    background: rgb(33, 37, 41);
    position: relative;
    padding: 20px;
    border-radius: 10px;
    max-width: 320px;
}
.speech::after {
    content: "";
    border: 20px solid transparent;
    position: absolute;
}
.right.speech::after {
    border-left-color: rgb(33, 37, 41);
    border-right: 0;
    right: -20px;
    top: 50%;
    margin-top: -20px;
}
.left.speech::after {
    border-right-color: rgb(33, 37, 41);
    border-left: 0;
    left: -20px;
    top: 50%;
    margin-top: -20px;
}
</style>
