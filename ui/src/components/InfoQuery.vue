<template>
    <p v-if="type !== 'deals'">Additional info needed</p>
    <input v-model="input" v-if="type == 'sales'">
    <div v-if="type == 'season'">
        <VueDatePicker v-model="dateStart"></VueDatePicker>
        <VueDatePicker v-model="dateEnd"></VueDatePicker>
    </div>
</template>

<script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    components: { VueDatePicker },
    props: {
        type: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            input: '',
            dateStart: null,
            dateEnd: null
        }
    },
    watch: { 
        input: function(newVal, oldVal) {
            console.log('Input changed: ', oldVal, ' --> ', newVal)
        }
    }
};
</script>