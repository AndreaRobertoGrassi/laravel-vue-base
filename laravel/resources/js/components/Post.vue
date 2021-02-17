<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3" >
                    <div class="card-header">

                        <h1>{{ title }}</h1>
                        <input type="text" v-model="postTitle">
                        
                    </div>

                    <div class="card-body" @click="changeState()">
                        {{shortContent}} <br><br>
                    </div>
                    <div class="card-footer">
                        <div @click="setLike()">
                            <strong>Likes: {{heartCount}}</strong>
                            <i class="fa-heart" :class="heartIcon"></i>       <!--far: cuore vuoto, fas: pieno-->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                open: false,
                liked: false,

                postTitle: this.title,
                postContent: this.content,
                postLikes: this.likes

            };
            
        },
        methods:{
            changeState:function(){
                this.open= !this.open;  
            },

            setLike:function(){
                this.liked= !this.liked;
            }
        },
        computed:{
            shortContent:function(){          //tronca il testo se ha più di 100 caratteri
                const maxLng=100;
                return this.content.length > maxLng && !this.open
                    ? this.content.substring(0,100) + '...'
                    : this.content;   
            },
 
            heartCount:function(){       //aumento i like se clicco sul cuore
                return this.likes + (this.liked ? 1 : 0);
            },

            heartIcon: function(){     //cuore pieno o vuoto se clicco
                return this.liked ? 'fas' : 'far';
            }
            
        },
        props:{
            title:String,
            content:String,
            likes:Number
        },
       
    }
</script>