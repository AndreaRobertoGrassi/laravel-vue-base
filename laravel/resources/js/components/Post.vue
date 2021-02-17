<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" @click="changeState()">
                    <div class="card-header"><h1>{{ title }}</h1></div>

                    <div class="card-body">
                        {{shortContent}} <br><br>
                        <small>Likes: {{likes}}</small>
                        
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
                open:false
            };
            
        },
        methods:{
            changeState:function(){
                this.open= !this.open;  
            }
        },
        computed:{
            shortContent:function(){          //tronca il testo se ha più di 100 caratteri ed open == false
                return this.content.length > 100 && !this.open
                    ? this.content.substring(0,100) + '...'
                    : this.content;   
            }
            
        },
        props:{
            title:String,
            content:String,
            likes:Number
        },
       
    }
</script>