<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Staff from '@/Components/Staff.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

 defineProps(['staffinfo']);
const form = useForm({
    name: '',
    dob:'',
    address:'',
    contact_no:'',
   
});



</script>
 
<template>

    <Head title="staff" />
    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto  p-2 sm:p-6 lg:p-8 ">
            <form class="grid grid-cols-2 gap-3" @submit.prevent="form.post(route('staff.store'), { onSuccess: () => form.reset() })">
             <div>
             <InputLabel value="Name"/>
                <TextInput
                    v-model="form.name"
                    placeholder="name"
                    type="string"
                ></TextInput></div>
                <div>
                 <InputLabel value="Date of Birth"/>
                <TextInput
                    v-model="form.dob"
                    placeholder="Date Of Birth"
                    type="date"
                ></TextInput></div>
                <TextInput
                    v-model="form.address"
                    placeholder="Address"
                    type="string"
                ></TextInput>
                <TextInput
                    v-model="form.contact_no"
                    placeholder="Contact_no"
                    type="tel"
                ></TextInput>
                
                <p>
                <InputError :message="form.errors.name" class="mt-2" />
                <PrimaryButton type="submit" class="mt-4 bg-blue-400">submit</PrimaryButton></p>
                
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Staff
                    v-for="staff in staffinfo"
                    :key="staff.id"
                    :staff="staff"
                    
                 />
                <!-- for(i=0;i<chirps.length;i++){    } -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>

</style>