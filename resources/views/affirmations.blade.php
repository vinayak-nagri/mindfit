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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
         <script   src="https://code.jquery.com/jquery-3.7.1.js"   integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="   crossorigin="anonymous"></script>
    </head>
        <body>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
        <!-- <script src="{{ asset('js/app.js') }}"></script> -->

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
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <a href="{{ url('/affirmations') }}" class="active">Affirmations</a>
                        <a href="{{route('habit.tracker')}}">Habit Tracker</a>
                        <a href="{{route('journal.index')}}"> Journal </a>
                        <a href="{{route('audios')}}"> Meditation Audios </a>

                    @else
                        <a href="{{ route('login') }}" >Log in</a>
                    
                
            @endif
                        
                        <a href="{{route('profile.edit')}}"> Profile </a>
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

        <!-- resources/views/affirmations.blade.php -->

    <div class="page_header" style="background-image: url('{{ asset('storage/watercolor.jpg')}}');" >
        <!-- <style> background-image: url('storage/watercolor.jpg'); </style> -->
        <!-- <img src="{{asset('storage/watercolor.jpg')}}"> -->
        
        <div class="container p-3 mb-1">
             <h1 class="display-3" style="text-emphasis: filled; font-family: 'Vast Shadow';">Welcome to Affirmations</h1> 
        </div>
    </div>
   

    

    <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">
        @foreach($affirmations as $index => $affirmation)
            <div class="carousel-item {{ $index == 0 ? 'active' : ''}}" data-affirmation-id="{{ $affirmation->id }}">
                @if($affirmation -> image_path)
                    <img class="d-block w-100" src = "{{ asset('storage/' . $affirmation -> image_path)}}" height="500px" alt="Affirmation Image">
                @else
                    <img class="d-block w-100" src = "{{ asset('storage/hero.jpg')}}" height="500px" alt="Default Image">
                @endif
            </div>
             
        
        <!-- <button class="btn btn-primary save-favorite-btn" data-affirmation-id="{{ $affirmation->id }}">Save to Favorites</button> -->
        @endforeach
        </div>
        
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container mt-2">
        <div class="save_button">
            <button type="button" class="btn btn-primary save_button">Save as Favourite</button>   
        </div>
    </div>

    <div class="container">
    <h2> Your Saved Affirmations </h2>
    <!-- @if($savedAffirmations->count() > 0)  @foreach($savedAffirmations as $savedAffirmation)
        <img src = "{{ asset('storage/' . $savedAffirmation -> image_path)}}" height="200px" width="200px" alt="Affirmation Image">
        @endforeach
    @else
        <p>You don't have any saved affirmations yet.</p>
    @endif -->
</div>

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
<div class="container mt-4">
    <div class="card-group gap-2 d-flex">
                <!-- <div class="card"> -->
                    @if($savedAffirmations->count() > 0)  
                        @foreach($savedAffirmations as $savedAffirmation)
                            <div class="card affirmations flex-wrap">
                            <img class="card-img-top" src = "{{ asset('storage/' . $savedAffirmation -> image_path)}}" alt="Affirmation Image">
                            </div>
                            @endforeach
                    @else
                            <p>You don't have any saved affirmations yet.</p>
                    @endif        
</div>


   

    <script>
        $(document).ready(function () {
            $('.save_button').click(function () {
                // Get the active item in the carousel
                var activeItem = $('.carousel-item.active');
                
                // Extract the affirmation ID from the data-affirmation-id attribute
                var affirmationId = activeItem.data('affirmation-id');

                // Use the affirmationId as needed (e.g., send it to the server via AJAX)
                // console.log('Affirmation ID:', affirmationId);
                var form = $('<form method="POST" action="/save-favorite/' + affirmationId + '"></form>');
                form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                form.appendTo('body').submit();
            });
        });
    </script>






<!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('storage/affirmation_images/hkoCeVVf6fMVS9yNA8PWrkBrx53E33hlFCyW45qf.jpg') }}" alt="First slide" height="500px" >
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('storage/hero.jpg') }}" alt="Second slide" height="500px">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('storage/Meditation.jpg') }}" alt="Third slide" height="500px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->



<!-- Display success message if any -->


    <!-- Image Upload Form -->
    <!-- <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload Image</button>
    </form> -->

    <!-- Display affirmations with images -->
    <!-- @foreach($affirmations as $affirmation)
        <div>
            @if($affirmation->image_path)
                <img src="{{ asset('storage/' . $affirmation->image_path) }}" alt="Affirmation Image" height="200px" width="200px">
            @else
                
                <img src="{{ asset('Meditation.jpg') }}" alt="Default Image" height="200px" width="200px">
            @endif
            <p>Favorite Count: {{ $affirmation->favorite_count }}</p>
        </div>
    @endforeach -->

    
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




