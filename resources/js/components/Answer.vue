<!--<template>-->
    <!---->
<!--</template>-->

<script>
    export default {
        // name: "answer"

        props:['answer'],

        data(){
            return{
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                befoureEditBody: null
            }
        },

        methods: {
            edit(){
                this.befoureEditBody= this.body;
                this.editing= true;
            },

            cancel(){
                this.body= this.befoureEditBody;
                this.editing= false;
            },

            update() {
                axios.patch(`/questions/${this.questionId}/answers/${this.id}`, {
                    body: this.body
                }).then(res => {
                    alert(res.data.message);
                    this.editing= false;
                    this.bodyHtml = res.data.body_html;
                })
                    .catch(err => {
                        alert(err.response.data.message);
                    });
            },

        },
        computed: {
            isInvalid() {
                return this.body.length < 2;
            }
        }
    }
</script>

<!--<style scoped>-->

<!--</style>-->