<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3" v-show="!deleted" >

                    <!-- READ -->
                    <div class="card-header" v-show="!sCreator"> 

                        <h1 v-show="!isEditFocus('title')">      <!--se clicco sul titolo sparisce il titolo e rimane solo l'input-->
                            <i class="fas fa-trash-alt" @click="destroy()"></i>
                            <span @click="setEditFocus('title')">
                                {{ postTitle }}
                            </span>
                            
                        </h1>   
                        <input type="text" v-show="isEditFocus('title')" v-model="postTitle">     <!--se il parametro passato è uguale a editFocus allora sarà visibile-->
                        
                    </div>

                    <!-- WRITE -->
                    <div class="card-header" v-show="sCreator">
                        <span>NEW POST</span>
                        <input type="text" v-model="postTitle"> <!-- input titolo nuovo post-->  
                    </div>

                     <!-- READ -->
                    <div class="card-body" v-show="!sCreator">    
                        <p v-show="!isEditFocus('content')" @click="setEditFocus('content')">{{shortContent}} </p>

                        <textarea v-show="isEditFocus('content')" cols="90" rows="4" v-model="postContent"></textarea>

                        <button @click="update()" v-show="!isEditFocus('')" class="btn btn-primary">SAVE</button>    <!--salvare le modifiche -->
                        <button @click="cancel()" v-show="!isEditFocus('')" class="btn btn-danger">CANCEL</button>    <!--cancellare le modifiche -->
                    </div>
                    
                    <!-- WRITE -->
                    <div class="card-body" v-show="sCreator">     <!--rende visibile o meno l'intero testo-->

                        <textarea cols="90" rows="4" v-model="postContent"></textarea>

                        <button @click="create()" class="btn btn-primary">SAVE</button>          <!--salvare il nuovo post-->
                    </div>

                     <!-- READ -->
                    <div class="card-footer" v-show="!sCreator">
                        
                        <strong>Likes: {{heartCount}}</strong>
                        <i class="fa-heart" :class="heartIcon" @click="setLike()"></i>       <!--far: cuore vuoto, fas: pieno-->
                    
                    </div>
                    
                    <!-- WRITE -->
                    <div class="card-footer" v-show="sCreator">
                        
                        <strong>Likes: 0</strong>
                        <i class="fa-heart fas"></i>       <!--far: cuore vuoto, fas: pieno-->
                    
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
                sCreator: this.creator,
               
                deleted:false,

                editFocus: '',      //contiene la parola dell'elemento che vado a modificare

                liked: false,

                uPostTitle:this.title,
                uPostContent:this.content,
                uPostLikes:this.likes,

                sPostTitle:this.title,
                sPostContent:this.content,
                sPostLikes:this.likes,

                postId:this.id,
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

            create:function(){       //crea un nuovo post
                const post={
                    title: this.postTitle,
                    content: this.postContent
                };
                axios.post('/post/create', post)
                    .then(res=> {
                        this.postId=res.id;
                        this.uPostTitle = this.sPostTitle = res.title;
                        this.uPostContent = this.sPostContent = res.content;
                        this.uPostLikes = this.sPostLikes = 1;
                        this.sCreator=false;
                    })
                    .catch(e=>console.log('errore', e));
            },

            update:function(){             //salvo il nuovo post o le modifiche
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

            cancel:function(){              //cancella le modifiche al post
                this.postContent=this.uPostContent;
                this.postTitle=this.uPostTitle;

                this.setEditFocus('');
            },

            destroy: function(){          //elimina il post
                axios.get('/post/destroy/' + this.id)
                    .then(res=>{
                        this.deleted=true;
                    })
                    .catch(e=> console.log('Error'));
            }
        },

        computed:{
            shortContent:function(){          //tronca il testo se ha più di 100 caratteri
                const maxLng=100;
                return this.postContent!= undefined && this.postContent.length > maxLng
                    ? this.postContent.substring(0,maxLng) + '...'
                    : this.postContent;   
            },
 
            heartCount:function(){       //aumento i like se clicco sul cuore
                return this.sPostLikes + (this.liked ? 1 : 0);
            },

            heartIcon: function(){     //cuore pieno o vuoto se clicco
                return this.liked ? 'fas' : 'far';
            }
            
        },
        
        props:{
            id:Number,
            title:String,
            content:String,
            likes:Number,
            creator: Boolean
        },
       
    }
</script>