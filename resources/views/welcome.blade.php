<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>MindFit</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> -->
        

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/custom_styles.css') }}">

    </head>
        <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand navbar-dark">
            <div class="container header">
                <div >
                    <a href="{{ url('/') }}" class="navbar-brand"> <img src="{{asset('storage/blue_mindfit.png')}}" height='50px' width='150px' alt='MindFit Logo'>  </img> </a>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                    @if (Route::has('login'))
                <div class="links d-flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" >Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                    </li>
                </ul>
            </div>
        </nav>

        <div class="hero_image ">
                <img class="hero_image img-fluid" src="{{asset('storage/hero.jpg')}}" alt="Hero Image"> </img>
        </div>

        <div class="container mt-4">
            <div class="card-group">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Title </h2>
                        <span class="card-subtitle"> Subtitle </span>
                        <div class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet blanditiis ipsam magnam architecto, alias exercitationem quis optio fuga mollitia tenetur laborum recusandae velit reiciendis maiores id culpa assumenda sapiente? Numquam!
                        </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Title </h2>
                        <span class="card-subtitle"> Subtitle </span>
                        <div class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet blanditiis ipsam magnam architecto, alias exercitationem quis optio fuga mollitia tenetur laborum recusandae velit reiciendis maiores id culpa assumenda sapiente? Numquam!
                        </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Title </h2>
                        <span class="card-subtitle"> Subtitle </span>
                        <div class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet blanditiis ipsam magnam architecto, alias exercitationem quis optio fuga mollitia tenetur laborum recusandae velit reiciendis maiores id culpa assumenda sapiente? Numquam!
                        </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Title </h2>
                        <span class="card-subtitle"> Subtitle </span>
                        <div class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet blanditiis ipsam magnam architecto, alias exercitationem quis optio fuga mollitia tenetur laborum recusandae velit reiciendis maiores id culpa assumenda sapiente? Numquam!
                        </div>
                    </div>      
                </div>
                </div>
            </div>
            </div>
        <div>



        
        </body>
</html>

<!-- bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 -->