<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white p-6 rounded shadow-lg z-10 w-1/2">
            <h2 class="text-2xl mb-4">Edit Patient</h2>
            <form @submit.prevent="submit">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="form.name" required>
                </div>
                <div>
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" v-model="form.dob" required>
                </div>
                <div>
                    <label for="contact_no">Contact No:</label>
                    <input type="text" id="contact_no" v-model="form.contact_no" required>
                </div>
                <div>
                    <label for="medical_condition">Medical Condition:</label>
                    <input type="text" id="medical_condition" v-model="form.medical_condition" required>
                </div>
                <div>
                    <label for="doctor_id">Doctor:</label>
                    <select id="doctor_id" v-model="form.doctor_id" required>
                        <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                            {{ doctor.name }}
                        </option>
                    </select>
                </div>
                <InputError :message="errors.name" />
                <PrimaryButton type="submit">Update Patient</PrimaryButton>
                <button type="button" @click="show = false">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps(['patient', 'doctors', 'show']);
const emit = defineEmits(['close']);

const form = useForm({
    name: props.patient.name,
    dob: props.patient.dob,
    contact_no: props.patient.contact_no,
    medical_condition: props.patient.medical_condition,
    doctor_id: props.patient.doctor_id
});


console.log("here")

const errors = computed(() => form.errors);

const submit = () => {
    form.put(route('patient.update', props.patient.id), {
        onSuccess: () => emit('close')
    });
};

watch(() => props.show, (value) => {
    if (!value) {
        form.reset();
        form.clearErrors();
    }
});
</script>
