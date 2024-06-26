<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm, Head } from "@inertiajs/vue3";
import Patient from "@/Components/Patient.vue";
import { ref, computed } from "vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
} from "@headlessui/vue";

// // const people = [
// //     { id: 1, name: "Durward Reynolds" },
// //     { id: 2, name: "Kenton Towne" },
// //     { id: 3, name: "Therese Wunsch" },
// //     { id: 4, name: "Benedict Kessler" },
// //     { id: 5, name: "Katelyn Rohan" },
// ];
import { CheckIcon } from "@heroicons/vue/24/outline";
let selected = ref([]);
const query = ref("");

const props = defineProps(["patientinfo", "doctorinfo","medical_conditions"]);
let filteredPeople = computed(() =>
    query.value === ""
        ? props.doctorinfo
        : props.doctorinfo.filter((person) =>
              person.name
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, ""))
          )
);
let filteredDiseases = computed(() =>
    query.value === ""
        ? props.medical_conditions
        : props.medical_conditions.filter((medical_condition) =>
              medical_condition.medical_condition
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, ""))
          )
);

const form = useForm({
    name: "",
    dob: "",
    medical_condition: "",
    contact_no: "",
    doctor_id: "",
    doctors: [],
    medical_conditions:[],

});

function submit() {
    console.log("submit");
    form.doctors = form.doctors.map((e) => e.id);
    form.medical_conditions = form.medical_conditions.map((e) => e.id);

    form.post(
        route("patient.store"),
        { onSuccess: () => form.reset() },
        { onError: (err) => console.log(err) }
    );
    // axios.post("/patient",form).catch(err => console.log(err))
}

// function addDoctor(){

//     if(!form.doctor_id){
//         window.alert("Please select doctor")
//         return 0
//     }

//     else if(form.doctors.map(e =>e.id).includes(form.doctor_id.id))
//     {
//         window.alert("ALready selected")
//         return 0
//     }
//    else
//    form.doctors.push(form.doctor_id),form.doctor_id=''
// }
</script>

<template>
    <Head title="patient" />
    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-2 sm:p-6 lg:p-8">
            <form
                @submit.prevent="submit()"
                class="grid grid-cols-2 gap-3 px-24"
            >
                <!-- <InputLabel value="Name"/> -->
                <div>
                    <InputLabel value="Name" />
                    <TextInput
                        v-model="form.name"
                       
                        autocomplete="on"
                        class="px-3 h-8 "
                    />
                </div>
                <div>
                    <InputLabel value="Date of Birth" />
                    <TextInput
                        v-model="form.dob"
                        placeholder="Date Of Birth"
                        type="date"
                        autocomplete="on"
                        class="px-3 h-8"
                    />
                </div>
                <div>
                    <InputLabel value="Contact: " />
                    <TextInput v-model="form.contact_no" class="h-8" />
                </div>
                 <div>
                    <InputLabel value="Select Doctor" />
                    <Combobox v-model="form.doctors" multiple>
                        <div class="relative">
                            <div
                                class="relative w-full cursor-default rounded-lg bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                            >
                                <ComboboxInput
                                    class="border-gray-300 focus:border-indigo-500 
                                    h-8 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                    :displayValue="(person) => person.name"
                                    @change="query = $event.target.value"
                                />
                                <ComboboxButton
                                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                                >
                                    <ChevronUpDownIcon
                                        class="h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </ComboboxButton>
                            </div>
                            <TransitionRoot
                                leave="transition ease-in duration-100"
                                leaveFrom="opacity-100"
                                leaveTo="opacity-0"
                                @after-leave="query = ''"
                            >
                                <ComboboxOptions
                                    class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                >
                                    <div
                                        v-if="
                                            filteredPeople.length === 0 &&
                                            query !== ''
                                        "
                                        class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                    >
                                        Nothing found.
                                    </div>

                                    <ComboboxOption
                                        v-for="person in filteredPeople"
                                        as="template"
                                        :key="person.id"
                                        :value="person"
                                        v-slot="{ selected, active }"
                                    >
                                        <li
                                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                                            :class="{
                                                'bg-teal-600 text-white':
                                                    active,
                                                'text-gray-900': !active,
                                            }"
                                        >
                                            <span
                                                class="block truncate"
                                                :class="{
                                                    'font-medium': selected,
                                                    'font-normal': !selected,
                                                }"
                                            >
                                                {{ person.name }}
                                            </span>
                                            <span
                                                v-if="
                                                    form.doctors
                                                        .map((e) => e.id)
                                                        .includes(person.id)
                                                "
                                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                :class="{
                                                    'text-white': form.doctors
                                                        .map((e) => e.id)
                                                        .includes(person.id),
                                                    'text-slate-900': !active,
                                                }"
                                            >
                                                <CheckIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </TransitionRoot>
                        </div>
                    </Combobox>
                </div>
                <!-- <div class="col-start-1">
                <InputLabel value="Medical Conditions"/>
                    <textarea
                        v-model="form.medical_condition"
                        placeholder="Write his/her Medical_Conditions"
                        autocomplete="on"
                        rows="3" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-none w-full"
                    />
                </div> -->
                <div>
                    <InputLabel value="Select Diseases" />
                    <Combobox v-model="form.medical_conditions" multiple>
                        <div class="relative">
                            <div
                                class="relative w-full cursor-default rounded-lg bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                            >
                                <ComboboxInput
                                    class="border-gray-300 focus:border-indigo-500 
                                    h-8 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                    :displayValue="(medical_condition) => medical_condition.medical_condition"
                                    @change="query = $event.target.value"
                                />
                                <ComboboxButton
                                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                                >
                                    <ChevronUpDownIcon
                                        class="h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </ComboboxButton>
                            </div>
                            <TransitionRoot
                                leave="transition ease-in duration-100"
                                leaveFrom="opacity-100"
                                leaveTo="opacity-0"
                                @after-leave="query = ''"
                            >
                                <ComboboxOptions
                                    class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                >
                                    <div
                                        v-if="
                                            filteredDiseases.length === 0 &&
                                            query !== ''
                                        "
                                        class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                    >
                                        Nothing found.
                                    </div>

                                    <ComboboxOption
                                        v-for="person in filteredDiseases"
                                        as="template"
                                        :key="medical_condition.id"
                                        :value="medical_condition"
                                        v-slot="{ selected, active }"
                                    >
                                        <li
                                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                                            :class="{
                                                'bg-teal-600 text-white':
                                                    active,
                                                'text-gray-900': !active,
                                            }"
                                        >
                                            <span
                                                class="block truncate"
                                                :class="{
                                                    'font-medium': selected,
                                                    'font-normal': !selected,
                                                }"
                                            >
                                                {{ medical_condition.name }}
                                            </span>
                                            <span
                                                v-if="
                                                    form.medical_conditions
                                                        .map((e) => e.id)
                                                        .includes(person.id)
                                                "
                                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                :class="{
                                                    'text-white': form.medical_conditions
                                                        .map((e) => e.id)
                                                        .includes(medical_condition.id),
                                                    'text-slate-900': !active,
                                                }"
                                            >
                                                <CheckIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </TransitionRoot>
                        </div>
                    </Combobox>
                </div>
               

                <div class="col-start-1">
                    <InputError :message="form.errors.name" class="mt-2" />
                    <PrimaryButton type="submit" class="mt-4 bg-blue-400"
                        >submit</PrimaryButton
                    >
                </div>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Patient
                    v-for="patient in patientinfo"
                    :key="patient.id"
                    :patient="patient"
                />
                <!-- for(i=0;i<chirps.length;i++){    } -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
