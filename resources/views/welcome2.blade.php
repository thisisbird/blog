<meta name="csrf-token" content="{{csrf_token()}}" />
<script src="{{ asset('js/app.js')}}"></script>
<script>
Echo.channel('home')
.listen('NewMessage', (e)=>{
console.log(e.message);
})
</script>