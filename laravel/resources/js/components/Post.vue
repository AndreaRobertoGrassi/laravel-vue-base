<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3" >
                    <div class="card-header" @click="setEditFocus('title')">   <!--se clicco sul titolo posso modificarlo-->

                        <h1 v-show="!isEditFocus('title')">{{ title }}</h1>   <!--se clicco sul titolo sparisce il titolo e rimane solo l'input-->
                        <input type="text" v-show="isEditFocus('title')" v-model="postTitle">     <!--se il parametro passato è uguale a ediFocus allora sarà visibile-->
                        
                    </div>

                    <div class="card-body">     <!--rende visibile o meno l'intero testo-->
                        <p v-show="!isEditFocus('content')" @click="setEditFocus('content')">{{shortContent}} </p>

                        <textarea v-show="isEditFocus('content')" cols="90" rows="4" v-model="postContent"></textarea>

                        <button @click="setEditFocus('')"  v-show="!isEditFocus('')" class="btn btn-primary">SAVE</button>
                    </div>
                    <div class="card-footer">
                        
                        <strong>Likes: {{heartCount}}</strong>
                        <i class="fa-heart" :class="heartIcon" @click="setLike()"></i>       <!--far: cuore vuoto, fas: pieno-->
                    
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
                editFocus: '',      //contiene la parola dell'elemento che vado a modificare

                liked: false,

                postTitle: this.title,
                postContent: this.content,
                postLikes: this.likes

            };
            
        },
        methods:{

            setLike:function(){
                this.liked= !this.liked;
            },
            setEditFocus:function(elem){     //valorizza editFocus
                this.editFocus=elem;
            },
            isEditFocus:function(elem){      //confrontiamo le due stringhe, se da falso deve sparire l'input
                return this.editFocus===elem;
            }
        },
        computed:{
            shortContent:function(){          //tronca il testo se ha più di 100 caratteri
                const maxLng=100;
                return this.content.length > maxLng
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