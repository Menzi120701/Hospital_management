<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Department from '@/Components/Department.vue';

 defineProps(['departmentinfo']);
const form = useForm({
    name: '',
   
});



</script>
 
<template>
    <Head title="department" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('department.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.name"
                    placeholder="Write department name"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.name" class="mt-2" />
                <PrimaryButton type="submit" class="mt-4 bg-red-400">submit</PrimaryButton>
                
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Department
                    v-for="name in departmentinfo"
                    :key="name.id"
                    :department="name"
                    
                 />
                <!-- for(i=0;i<chirps.length;i++){    } -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>

</style>