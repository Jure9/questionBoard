<template>
    <a title="Click to mark as favourite question" :class="classes" @click.prevent="toggle">

        <i class="fas fa-star fa-2x"></i>
        <span class="favourites-count">{{ count }}</span>

    </a>
</template>

<script>
    export default {
        props: ['question'],

        data(){
            return{
                isFavourited: this.question.is_favourited,
                count: this.question.favourites_count,
                id: this.question.id
            }
        },

        computed:{
            classes(){
                return [
                    'favourite', 'mt-2',
                    !this.signedIn ? 'off' : (this.isFavourited ? 'favourited' : '')
                ];
            },

            endpoint(){
                return `/questions/${ this.id }/favourites`;
            },

            signedIn(){
                return window.Auth.signedIn;
            }
        },

        methods: {
            toggle(){
                if (!this.signedIn)
                {
                    this.$toast.warning("Please login to favourite this question", "Warning", {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                this.isFavourited ? this.destroy() : this.create();
            },

            destroy(){
                axios.delete(this.endpoint)
                    .then(res=>{
                        this.count--;
                        this.isFavourited= false;
                    });

            },

            create(){
                axios.post(this.endpoint)
                    .then(res =>{
                        this.count++;
                        this.isFavourited= true
                    });
            }
        }
    }
</script>
