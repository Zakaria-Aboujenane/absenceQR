<div class="container">

    @isset($url)
        <h1>Register for {{$url}}</h1>
        <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Login') }}">
    @else
                <h1>Register for Etudiant by Default</h1>
        <form method="POST" action="{{ route('register/etudiant') }}" aria-label="{{ __('Login') }}">
    @endisset
                    @csrf
                    @error('email')
                    <p class="">{{$message}}</p>
                    @enderror
                    name            : <input type="text" name="name" id=""> <br>
                    email           : <input type="email" name="email"> <br>
                    cin             : <input type="text" name="cin"> <br>
                    password        : <input type="password" name="password" id=""> <br>
            @if($url == 'etudiant')
                    cne             : <input type="text" name="cne" id=""> <br>
                    email parent    : <input type="email" name="email_parent" id=""> <br>
            @endif

                    <input type="submit" value="register">
</div>
