<template>
    <div class="col-3">
        <a class="btn btn-success" @click="acceptApplication" :disabled="buttonDisabled">Accept</a>
    </div>
    <div class="col-3">
        <a class="btn btn-danger" @click="declineApplication"  :disabled="buttonDisabled">Decline</a>
    </div>

    <div>
        <b-button v-b-modal.modal-1>Launch demo modal</b-button>

        <b-modal id="modal-1" title="BootstrapVue">
            <p class="my-4">Hello from modal!</p>
        </b-modal>
    </div>
</template>

<script>
    export default {
        props: ['applicationId'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.applicationId,
                popupActivo: false,
            }
        },
        methods: {
            acceptApplication() {
                console.log(this.applicationId);
                /*
                axios.post('/apply/' + this.jobId)
                    .then(response => {
                        this.status = ! this.status;
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
                    */
            },
            declineApplication() {
                /*
                axios.post('/apply/' + this.jobId)
                    .then(response => {
                        this.status = ! this.status;
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
                    */
            }
        },
        computed: {
            acceptButtonText() {
                //return (this.status) ? 'Already applied' : 'Apply';
            },
            declineButtonText() {
                //return (this.status) ? 'Already applied' : 'Apply';
            },

            buttonDisabled(){
               // return (this.status) ? true : false;
            }
        }
    }
</script>