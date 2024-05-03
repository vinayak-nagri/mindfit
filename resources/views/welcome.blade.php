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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
        

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
                        <!-- <a href="{{ url('/dashboard') }}">Dashboard</a> -->
                        <span>Hi, {{ Auth::user()->name }}!</span>
                        <a href="{{route('affirmations')}}">Affirmations</a>
                        <a href="{{route('habit.tracker')}}">Habit Tracker</a>
                        <a href="{{route('journal.index')}}"> Journal </a>
                        <a href="{{route('audios')}}"> Meditation Audios </a>
                        <!-- <a href="{{route('profile.edit')}}"> Profile </a> -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
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

        <!-- <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Fluid jumbotron</h1>
                <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
        </div> -->

        <div class="my-5">
            <div class="p-5 text-center bg-primary bg-opacity-5 rounded-pill">
                <div class="container py-5">
                    <u class="text-light"> <h1 class="text-light" style="font-family: 'Georgia'; font-size: 50px;">Improve Your Mental Health With Proven Methods </h1> </u>
                    <p class="col-lg-8 mx-auto lead text-light">
                    Empower your mental well-being with our holistic support web app, offering personalized journaling, habit tracking, 
                    uplifting affirmations, and soothing meditation audios—all designed to cultivate a positive and resilient mindset for 
                    a healthier and happier you.
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-4 d-flex justify-content-center">
            <div class="card-group ml-6">
            <div class="row flex-row ml-6">
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Journaling </h2>
                        <!-- <span class="card-subtitle"> Subtitle </span> -->
                        <div class="card-text">
                        Capture your thoughts in a personalized sanctuary with our rich text journal feature. Organize your 
                        journey seamlessly by tagging entries, creating a tailored reflection space for your unique experiences.                         </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/Meditation.jpg')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Breathwork & Meditation Audios </h2>
                        <!-- <span class="card-subtitle"> Subtitle </span> -->
                        <div class="card-text">
                        Immerse yourself in tranquility with our meditation audios, thoughtfully categorized by time duration and 
                        moods such as energy, calming, and focus.                     
                        </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/Habit_Tracker.jpg')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Habit Tracker </h2>
                        <!-- <span class="card-subtitle"> Subtitle </span> -->
                        <div class="card-text">
                        Transform your routine with our weekly habit tracker, seamlessly integrating progress monitoring into 
                        your lifestyle. Reflect on your journey by reviewing past week records, empowering you to cultivate 
                        lasting positive habits.
                    </div>
                    </div>      
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/Affirmations.jpg')}}"/>
                    <div class="card-body">
                        <h2 class="card-title"> Affirmations </h2>
                        <!-- <span class="card-subtitle"> Subtitle </span> -->
                        <div class="card-text">
                        Elevate your mindset with our affirmations feature, delivering a daily dose of positivity. Explore a 
                        diverse array of uplifting affirmations and curate your favorites for a personalized reservoir of 
                        inspiration.                        
                    </div>
                    </div>      
                </div>
                </div>
            </div>
            </div>
</div>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="mb-3 mb-md-0 text-muted">© MindFit</span>
    </div>

   
  </footer>
</div>
        
        </body>
</html>

<!-- bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 -->