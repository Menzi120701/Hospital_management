<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Medical_Condition from '@/Components/Medical_Condition.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
 defineProps(['medical_conditions']);
const form = useForm({
    medical_condition: '',
   
});



</script>
 
<template>
    <Head title="Medical Conditions" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('medical_condition.store'), { onSuccess: () => form.reset() })">
                <div><InputLabel value="Enter the Diseases"/>
                <TextInput
                    v-model="form.medical_condition"
                   
                    class="block w-full border-gray-300 focus:border-indigo-200 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                /></div>
                <InputError :message="form.errors.name" class="mt-2" />
                <PrimaryButton type="submit" class="mt-4 bg-red-400">submit</PrimaryButton>
                
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Medical_Condition
                    v-for="medical_condition in medical_conditions"
                    :key="medical_condition.id"
                    :medical_condition="medical_condition"
                    
                 />
                <!-- for(i=0;i<chirps.length;i++){    } -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>

</style>