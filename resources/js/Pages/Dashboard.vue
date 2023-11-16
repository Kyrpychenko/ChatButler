<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { TextInput, Button } from "custom-mbd-components";
import { ref } from "vue";
import { Message, User, Chat } from "@/types/index";
import { toRefs } from "vue";
const props = defineProps<{
    currentUser: User;
    messages: Message[];
}>();
const { currentUser, messages } = toRefs(props);
const inputMessage = ref("");
const messageForm = useForm<{ text: string; sent: Date }>({
    text: inputMessage.value,
    sent: new Date(),
});

function addMessage() {
    messageForm.post(route("storeMessage"), { preserveScroll: true });
    inputMessage.value = "";
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div
            class="fixed-bottom d-flex justify-content-center align-items-center mb-4"
        >
            <TextInput
                v-model="inputMessage"
                style="width: 60vw"
                placeholder="Schreiben Sie eine Nachricht"
            ></TextInput>
            <Button class="mt-3 btn btn-primary" @click="addMessage()"
                >Abschicken</Button
            >
        </div>
        <template v-for="message in messages">
            <div>{{ message.text }}</div>
        </template>
    </AuthenticatedLayout>
</template>
