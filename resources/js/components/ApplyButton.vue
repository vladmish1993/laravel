<template>
    <div>
        <button class="btn btn-primary ml-4" @click="applyToJob" v-text="buttonText"
                :disabled="buttonDisabled"></button>
    </div>
</template>

<script>
    export default {
        props: ['jobId', 'applied'],
        mounted() {
            //console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.applied,
            }
        },
        methods: {
            applyToJob() {
                axios.post('/apply/' + this.jobId)
                    .then(response => {
                        this.status = !this.status;
                    })
                    .catch(errors => {
                        if (errors.response.status === 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Already applied' : 'Apply';
            },
            buttonDisabled(){
                return !!(this.status);
            }
        }
    }
</script>