<template>
    <div>
        <button class="btn btn-primary ml-4" @click="seeNotification">Noted</button>
    </div>
</template>

<script>
    export default {
        props: ['notificationId'],
        mounted() {
            //console.log('Component mounted.')
        },
        data: function () {
            return {}
        },
        methods: {
            seeNotification() {
                axios.patch('/notificationview/' + this.notificationId)
                    .then(response => {
                        window.location = '/notifications';
                    })
                    .catch(errors => {
                        if (errors.response.status === 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
        }
    }
</script>