<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Apps</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>

<body>
    <div id="app">
        <router-link to="/home">Home</router-link>
        <router-link to="/about">about</router-link>
        ​
        <router-view></router-view>
        
    </div>
    <div id="comment">
        <textarea name="body" id="" cols="30" rows="10" v-model="commentBox"></textarea>
        <button @click.prevent="postComment">save</button>
        <div v-for="comment in comments">
                @{{comment.user.name}} said...
                @{{comment.body}}
        
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
<script>
    
const app = new Vue({
            el:'#comment',
            data:{
                comments: {},
                commentBox: '',
                post : @json($post),
                user : {!! Auth::check() ? Auth::user()->toJson : 'null' !!}
            },
            mounted() {
                this.getComments();
                this.listen();
            },
            methods:{
                getComments(){
                    axios.get(`/api/posts/${this.post.id}/comments`)
                    .then((response)=>{
                        this.comments = response.data
                    })
                    .catch(function(error){
                        console.log(error);
                    });
                },
                postComment(){
                    axios.post(`/api/posts/${this.post.id}/comments`,{
                        // api_token: this.user.api_token,
                        body: this.commentBox
                    })
                    .then((response)=>{
                        this.comments.unshift(response.data);
                        this.commentBox = '';
                    })
                    .catch(function(error){
                        console.log(error);
                    });
                },
                listen(){
                    console.log(this.post.id);
                    Echo.channel('post.'+this.post.id)
                        .listen('NewMessage',(comment)=>{
                            this.comments.unshift(comment);
                        })
                }
            }
});

</script>

</html>