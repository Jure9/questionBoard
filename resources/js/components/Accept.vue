<template>
    <div>
<<<<<<< HEAD

=======
>>>>>>> rewrite/auth-logic
        <a v-if="canAccept" title="Mark this answer as best" :class="classes" @click.prevent="create">
            <i class="fas fa-check fa-2x"></i>
        </a>

<<<<<<< HEAD
        <a v-if="accepted" title=" this is best answer"
=======
        <a v-if="accepted" title="Mark this answer as best"
>>>>>>> rewrite/auth-logic
           :class="classes">
            <i class="fas fa-check fa-2x"></i>

        </a>
<<<<<<< HEAD

    </div>
=======
    </div>

>>>>>>> rewrite/auth-logic
</template>

<script>
    export default {
        props: ['answer'],

        data(){
<<<<<<< HEAD
            return{
                isBest: this.answer.is_best,
                id: this.answer.id
            }
        },

        methods:{
            create(){
                axios.post(`/answers/${this.id}/accept`)
                    .then(res => {
                        this.$toast.success(res.data.message, "Success", {
                            timeout: 3000,
                            position: 'bottomLeft'
                        });

                        this.isBest= true;
                    })
            }
        },

        computed: {
            canAccept(){
                return true;
            },

            accepted(){
=======
           return {
               isBest: this.answer.is_best,
               id: this.answer.id
           }
        },

        methods:{
          create(){
              axios.post(`/answers/${this.id}/accept`)
                  .then(res=>{
                     this.$toast.success(res.data.message, "Success", {
                         timeout: 3000,
                         position: 'bottomLeft'
                     }) ;

                     this.isBest= true;
                  })
          }
        },

        computed: {
            canAccept() {
                return this.authorize('accept', this.answer);
            },

            accepted() {
>>>>>>> rewrite/auth-logic
                return !this.canAccept && this.isBest;
            },

            classes(){
                return [
                    'mt-2',
                    this.isBest ? 'vote-accepted' : ''
<<<<<<< HEAD
                ];
=======
                ]
>>>>>>> rewrite/auth-logic
            }
        }
    }
</script>
<<<<<<< HEAD
=======

>>>>>>> rewrite/auth-logic
