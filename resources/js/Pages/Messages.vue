<script setup>

import {useForm} from "@inertiajs/vue3"


    const form = useForm({
        message:""
    }) 

    const props = defineProps(["messages"])
    console.log(props.messages)
</script>


<template>
{{
    messages
}}
<form @submit.prevent="form.post(route('messages.store'))">
<input v-model="form.message">
<button>submit</button>
</form>
</template>