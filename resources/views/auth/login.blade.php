<div class="container">

    @isset($url)
        <h1>Login for {{$url}}</h1>
<form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
    @else
        <h1>Login for Etudiant by Default</h1>
<form method="POST" action="{{ route('login/etudiant') }}" aria-label="{{ __('Login') }}">
    @endisset
    @csrf
    @error('email')
    <p class="">{{$message}}</p>
    @enderror
    email : <input type="email" name="email"> <br>
    password: <input type="password" name="password" id="">
    <input type="submit" value="connect">
</div>
