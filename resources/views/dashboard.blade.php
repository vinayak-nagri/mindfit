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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Vast+Shadow&display=swap" rel="stylesheet">
        

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/custom_styles.css') }}">

    </head>
        <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand">
            <div class="container header">
                <div >
                    <a href="{{ url('/') }}" class="navbar-brand"> <img src="{{asset('storage/blue_mindfit.png')}}" height='50px' width='150px' alt='MindFit Logo'>  </img> </a>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                    @if (Route::has('login'))
                <div class="links d-flex gap-4">
                    @auth
                        <span>Hi, {{ Auth::user()->name }}!</span>
                        <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>
                        <a href="{{route('affirmations')}}">Affirmations</a>
                        <a href="{{route('habit.tracker')}}">Habit Tracker</a>
                        <a href="{{route('journal.index')}}"> Journal </a>
                        <a href="{{route('audios')}}"> Meditation Audios </a>


                    @else
                        <a href="{{ route('login') }}" >Log in</a>
                    
                
            @endif
                        
                        <!-- <a href="{{route('profile.edit')}}"> Profile </a> -->
                    @endauth

                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="page_header" style="background-image: url('{{ asset('storage/watercolor.jpg')}}');" >
        <!-- <style> background-image: url('storage/watercolor.jpg'); </style> -->
        <!-- <img src="{{asset('storage/watercolor.jpg')}}"> -->
        
        <div class="container p-3 mb-1">
             <h1 class="display-3" style="text-emphasis: filled; font-family: 'Vast Shadow';">Your Dashboard</h1> 
        </div>
    </div>

    <figure class="text-center m-5">
    <h1> Access Your Digital Tools </h1>
 
</figure>

    <div class="container mt-4 d-flex justify-content-center">
            <div class="card-group ml-6">
            <div class="row flex-row ml-6">
                <div class="col-md-6 mb-4">
                
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/journal.png')}}"/>
                    
                    <div class="card-body">
                    <a href="{{route('journal.index')}}"> <h2 class="card-title"> Journaling </h2> </a>
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
                    <a href="{{route('audios')}}"> <h2 class="card-title"> Breathwork & Meditation Audios </h2> </a>
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
                    <a href="{{route('habit.tracker')}}"> <h2 class="card-title"> Habit Tracker </h2> </a>
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
                    <a href="{{route('affirmations')}}"> <h2 class="card-title"> Affirmations </h2>  </a>
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





