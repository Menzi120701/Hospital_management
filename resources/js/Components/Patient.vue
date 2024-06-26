<script setup>

import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import EditPatientModal from '@/Components/EditPatientModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref, computed} from 'vue';
 import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
  } from '@headlessui/vue';
const props = defineProps(['patient']);
// const form = useForm({
//     name: props.patient.name,
//     dob: props.patient.dob,
  //   contact_no: props.patient.contact_no,
   //  medical_condition:props.patient.medical_condition,
   //  doctors :patient.doctors.doctor_id

// });
 
const editing = ref(false);

</script>
 
<template>
    <div class="p-6 flex space-x-2">
        
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    
                    <small class="ml-2 text-sm text-gray-600">{{ new Date(patient.created_at).toLocaleString() }}</small>
                      <small v-if="patient.created_at !== patient.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
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
                    <DropdownLink as="button" :href="route('patient.destroy', patient.id)" method="delete">
                            Delete
                        </DropdownLink>
                        <DropdownLink as="button"  @click="editing = true">
                            Edit
                        </DropdownLink>
                         
                    </template>
                </Dropdown>
            </div>
                        <!-- <form v-if="editing" @submit.prevent="form.put(route('patient.update', patient.id), { onSuccess: () => editing = false })">
               <Combobox v-model="selectedPeople" multiple>
    <ul v-if="selectedPeople.length > 0">
      <li v-for="person in selectedPeople" :key="person.id">
        {{ person.name }}
      </li>
    </ul>
    <ComboboxInput />
    <ComboboxOptions>
      <ComboboxOption v-for="person in people" :key="person.id" :value="person">
        {{ person.name }}
      </ComboboxOption>
    </ComboboxOptions>
  </Combobox>
            </form> -->

            <p class="mt-4 text-lg text-gray-900">Patient's Name: {{ patient.name}}</p>
            <p class=" mt-2text-lg text-gray-900">Date of Birth: {{ patient.dob}}</p>
            <p class="mt-2 text-lg text-gray-900">Contact_no: {{ patient.contact_no}}</p>
            <p class="mt-2 text-lg text-gray-900">Medical Conditions: {{ patient.medical_condition}}</p>
            <div>
                Doctors:
                <p class="mt-4 text-lg text-gray-900" v-for="doctor in patient.doctors" :key='doctor.id'>
                {{doctor.name}}
                </p>
            </div>
        </div>
    </div>


</template>