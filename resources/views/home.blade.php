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
        {{-- <textarea name="" id="" cols="30" rows="10" v-model="commentBox"></textarea> --}}
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
                post : {!! $post->toJson()!!},
                user : {!! Auth::check() ? Auth::user()->toJson : 'null' !!}
            },
            mounted() {
                this.getComments();
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
                postComments(){

                }
            }
});

</script>

</html>