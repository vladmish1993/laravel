<template>
    <div class="row pb-3" v-if="isButtonsVisible">
        <div class="col-3">
            <button class="btn btn-success" @click="acceptApplication" :disabled="buttonDisabled">Accept</button>
        </div>
        <div class="col-3">
            <button class="btn btn-danger" @click="declineApplication" :disabled="buttonDisabled">Decline</button>
        </div>
    </div>

    <div class="row" v-if="isCommentVisible">
        <div class="comment-title">Please write a comment below:</div>
        <label>
            <textarea class="form-control" rows="4" cols="50" v-model="comment"></textarea>
        </label>

        <div class="row pt-2">
            <div class="col-3">
                <button class="btn btn-primary" @click="sendApplication" :disabled="buttonSendDisabled">Send</button>
            </div>
            <div class="col-3">
                <button class="btn btn-dark" @click="cancelApplication">Cancel</button>
            </div>
        </div>
    </div>

    <div class="row" v-if="isResultVisible">
        <div class="feedback-title">Feedback has been sent!</div>
    </div>
</template>

<script>
    export default {
        props: ['jobId', 'applicationId'],
        mounted() {
            //console.log('Component mounted.')
        },
        data: function () {
            return {
                status: false,
                comment: '',
                isButtonsVisible: true,
                isCommentVisible: false,
                isResultVisible: false
            }
        },
        methods: {
            cancelApplication() {
                this.status = false;
                this.isCommentVisible = !this.isCommentVisible;
                this.comment = '';
            },
            acceptApplication() {
                this.status = true;
                this.isCommentVisible = !this.isCommentVisible;
            },
            declineApplication() {
                this.status = false;
                this.isCommentVisible = !this.isCommentVisible;
            },
            sendApplication() {
                if (this.comment) {
                    axios.post('/applicationanswer/' + this.applicationId, {
                        status: this.status,
                        comment: this.comment
                    })
                        .then(response => {
                            this.isCommentVisible = false;
                            this.isButtonsVisible = false;
                            this.isResultVisible = true;
                            this.status = false;
                        })
                        .catch(errors => {
                            if (errors.response.status === 401) {
                                window.location = '/login';
                            }
                        });
                }
            }
        },
        computed: {
            buttonDisabled(){
                return !!(this.status);
            },
            buttonSendDisabled(){
                return this.comment.length < 5;
            }
        }
    }
</script>