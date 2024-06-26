<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
const props = defineProps(['department']);

</script>
 
<template>
    <div class="p-6 flex space-x-2">
        
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    
                    <small class="ml-2 text-sm text-gray-600">{{ new Date(department.created_at).toLocaleString() }}</small>
                </div>
                <Dropdown >
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                    <DropdownLink as="button" :href="route('department.destroy', department.id)" method="delete">
                            Delete
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ department.name}}</p>
        </div>
    </div>
</template>