<script setup lang="ts">
import CustomTable from '@/Components/App/CustomTable.vue';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PaginatedResponse, SendMessageResource, TableColumn } from '@/types/allType';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    sendMessages: PaginatedResponse<SendMessageResource>;
}>();

const columns = ref<TableColumn[]>([
    {
        key: 'sender',
        label: 'Sender',
        width: '20%'
    },
    {
        key: 'receiver',
        label: 'Receiver',
        width: '20%'
    },
    {
        key: 'message',
        label: 'Message',
        width: '40%'
    },
    { key: 'status', label: 'Status', width: '20%' },
    { key: 'created_at', label: 'Sent At', width: '20%' },
    { key: 'delivered_at', label: 'Delivered At', width: '20%' }
]);

const form = useForm({
    sender: '',
    receiver: '',
    message: ''
});

const sendMessage = () => {
    form.post(route('send-messages.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>Send Messages</template>
        <!-- Send Message Form -->
        <div
            class="mb-8 p-8 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm rounded-xl transition-all duration-300 hover:shadow-md">
            <h2
                class="text-2xl font-bold mb-6 bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">
                Send New Message</h2>
            <form @submit.prevent="sendMessage" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sender</label>
                        <input type="text" v-model="form.sender"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 transition-all duration-300"
                            placeholder="Enter sender phone number">
                        <InputError :message="form.errors.sender" />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Receiver</label>
                        <input type="text" v-model="form.receiver"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 transition-all duration-300"
                            placeholder="Enter receiver phone number">
                        <InputError :message="form.errors.receiver" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Message</label>
                    <textarea v-model="form.message" rows="4"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 transition-all duration-300"
                        placeholder="Enter your message"></textarea>
                    <InputError :message="form.errors.message" />
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <!-- Messages Table -->
        <h2 class="text-xl font-bold mb-6 bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">
            Send Messages List</h2>
        <CustomTable :items="props.sendMessages" :columns="columns" search-key="search"
            search-placeholder="Search messages...">
            <template #status="{ item }">
                <span class="text-sm font-medium px-4 py-1.5 rounded-full transition-all duration-300" :class="{
                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': item.status === 'Delivered',
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300': item.status === 'Pending',
                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300': item.status === 'Failed',
                    'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': item.status === 'Sent'
                }">
                    {{ item.status }}
                </span>
            </template>
        </CustomTable>
    </AuthenticatedLayout>
</template>
