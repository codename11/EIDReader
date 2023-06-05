@extends("layouts.app")

@section("content")

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-ws mx-auto">
        
        <a class="navbar-brand" href="/welcome">
            <img src="{{ asset('looking_glass.svg') }}" width="30" height="30" class="d-inline-block align-top" alt="logo">
            EIDReader
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/welcome">Welcome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index">Listing</a>
                </li>
            </ul>
        </div>

    </nav>

    <div class="nav-background-color flex-center position-ref full-height">
        
        <div class="content">
            <div class="title m-b-md">
                <img src="{{ asset('looking_glass.svg') }}" alt="logo">
                {{config("app.name", "EIDReader")}}
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
        </div>

    </div>

@endsection
