<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3" >
                    <div class="card-header" @click="setEditFocus('title')">   <!--se clicco sul titolo posso modificarlo-->

                        <h1 v-show="!isEditFocus('title')">{{ postTitle }}</h1>   <!--se clicco sul titolo sparisce il titolo e rimane solo l'input-->
                        <input type="text" v-show="isEditFocus('title')" v-model="postTitle">     <!--se il parametro passato è uguale a ediFocus allora sarà visibile-->
                        
                    </div>

                    <div class="card-body">     <!--rende visibile o meno l'intero testo-->
                        <p v-show="!isEditFocus('content')" @click="setEditFocus('content')">{{shortContent}} </p>

                        <textarea v-show="isEditFocus('content')" cols="90" rows="4" v-model="postContent"></textarea>

                        <button @click="update()" v-show="!isEditFocus('')" class="btn btn-primary">SAVE</button>
                        <button @click="cancel()" v-show="!isEditFocus('')" class="btn btn-danger">CANCEL</button>
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

                uPostTitle:this.title,
                uPostContent:this.content,

                sPostTitle:this.title,
                sPostContent:this.content,

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
            },
            update:function(){
                const post={
                    title: this.postTitle,
                    content: this.postContent
                };
                axios.post('/post/update/' + this.id, post)
                    .then(res=> {
                        console.log('response', res);
                        this.uPostTitle = this.sPostTitle = this.postTitle;
                        this.uPostContent = this.sPostContent = this.postContent;
                    })
                    .catch(e=>console.log('errore', e));
                    
                this.setEditFocus('')
            },
            cancel:function(){
                this.postContent=this.uPostContent;
                this.postTitle=this.uPostTitle;

                this.setEditFocus('');
            }
        },
        computed:{
            shortContent:function(){          //tronca il testo se ha più di 100 caratteri
                const maxLng=100;
                return this.postContent.length > maxLng
                    ? this.postContent.substring(0,maxLng) + '...'
                    : this.postContent;   
            },
 
            heartCount:function(){       //aumento i like se clicco sul cuore
                return this.likes + (this.liked ? 1 : 0);
            },

            heartIcon: function(){     //cuore pieno o vuoto se clicco
                return this.liked ? 'fas' : 'far';
            }
            
        },
        props:{
            id:Number,
            title:String,
            content:String,
            likes:Number
        },
       
    }
</script>