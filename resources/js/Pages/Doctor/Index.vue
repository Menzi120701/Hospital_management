<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Doctor from '@/Components/Doctor.vue';

 defineProps(['doctorinfo','departmentinfo','patientinfo']);
const form = useForm({
    name: '',
    contact_no: '',
    department_id: '',
    patient_id:'',
    patients:[]
   
});
function submit(){
    form.patients = form.patients.map(e => e.id)
    
    form.post(route('doctor.store'), { onSuccess: () => form.reset() },{onError:(err)=>console.log(err)})
}
function addPatient(){
      if(!form.patient_id){
        window.alert("Please select patient")
        return 0
    }

    else if(form.patients.map(e =>e.id).includes(form.patient_id.id))
    {
        window.alert("ALready selected")
        return 0
    }
   else  
   form.patients.push(form.patient_id),form.patient_id=''
}


</script>
 
<template>
    <Head title="doctor" />
    {{
        
    }}
    <AuthenticatedLayout>
        <div class="max-w-2xl  mx-auto  p-2 sm:p-6 lg:p-5 ">
        
            <form @submit.prevent="submit()" class="grid grid-cols-2 gap-3">
                 
                <label for="name">Name:</label>
                <input  name="name" v-model="form.name" type="text" placeholder="Name" required autocomplete="off">
              <label for="contact">Contact:</label>
                <input name="contact" v-model="form.contact_no" type="tel" autocomplete="off"  required>
            <!-- {{form}} -->
            <div class="grid grid-flow-row gap-2">
            <label for="department_id">Department</label>
                <select name="department_id" v-model="form.department_id" required>
                <option value="" selected disabled>Select Department</option>
            <option v-for='data in departmentinfo' :value='data.id'>{{ data.name }}</option>
             </select>
             </div>
             <div>
             <select name="patient_id" v-model="form.patient_id" >
             <option value='' selected disabled>Select the patient</option>
             <option v-for="patient in patientinfo" :value="patient">{{patient?.name}}</option>
             </select>
              <PrimaryButton type="button" @click.stop="addPatient">Add Patient</PrimaryButton>
             <div>
            <div v-for="(patient,index) in form.patients" :key="index">
                        <div>
                            {{patient?.name}} <DangerButton type="button" @click="form.patients.splice(index,1)">
                                Remove
                            </DangerButton>
                        </div>
                    </div>
             
             </div>
</div>
               
            
                <InputError :message="form.errors.name" class="mt-2" />
                <p>
                <PrimaryButton type="submit" class="mt-4 bg-green-400">submit</PrimaryButton>
                </p>
                
            </form>
          <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
          <Doctor
          v-for="doctor in doctorinfo"
          :key="doctor.id"
          :doctor="doctor"
          
          
          />
         
          </div>
        </div>
    </AuthenticatedLayout>
</template>
