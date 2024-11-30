<script setup lang="ts">
import CustomTable from '@/Components/App/CustomTable.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PaginatedResponse, SendMessageResource, TableColumn } from '@/types/allType';
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

</script>

<template>
    <AuthenticatedLayout>
        <template #header>Send Messages</template>
        <CustomTable :items="props.sendMessages" :columns="columns" search-key="search"
            search-placeholder="Search items...">
            <template #status="{ item }">
                <span class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full" :class="{
                    'bg-green-100 text-green-800': item.status === 'Delivered',
                    'bg-yellow-100 text-yellow-800': item.status === 'Pending',
                    'bg-red-100 text-red-800': item.status === 'Failed',
                    'bg-blue-100 text-blue-800': item.status === 'Sent'
                }">
                    {{ item.status }}
                </span>
            </template>
        </CustomTable>
    </AuthenticatedLayout>
</template>
