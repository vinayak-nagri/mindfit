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

        <!-- Audio Plyr Library -->
        <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />

        <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
          // Controls (as seen below) works in such a way that as soon as you explicitly define (add) one control
          // to the settings, ALL default controls are removed and you have to add them back in by defining those below.
          // For example, let's say you just simply wanted to add 'restart' to the control bar in addition to the default.
          // Once you specify *just* the 'restart' property below, ALL of the controls (progress bar, play, speed, etc) will be removed,
          // meaning that you MUST specify 'play', 'progress', 'speed' and the other default controls to see them again.
             const controls = [
              //'play-large', // The large play button in the center
               // Restart playback
              'rewind', // Rewind by the seek time (default 10 seconds)
              'play', // Play/pause playback
              'fast-forward', // Fast forward by the seek time (default 10 seconds)
              'progress', // The progress bar and scrubber for playback and buffering
              'current-time', // The current time of playback
              'duration', // The full duration of the media
              'mute', // Toggle mute
              'volume', // Volume control
              'restart',
              //'captions', // Toggle captions
              'settings', // Settings menu
              //'pip', // Picture-in-picture (currently Safari only)
              'airplay', // Airplay (currently Safari only)
              //'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
              //'fullscreen' // Toggle fullscreen
          ];
          const player = Plyr.setup('.js-player', { controls });
      });
  </script>

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
                        <!-- <a href="{{ url('/dashboard') }}" >Dashboard</a> -->
                        <a href="{{route('affirmations')}}">Affirmations</a>
                        <a href="{{route('habit.tracker')}}">Habit Tracker</a>
                        <a href="{{route('journal.index')}}"> Journal </a>
                        <a href="{{route('audios')}}" class="active"> Meditation Audios </a>

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
             <h1 class="display-3" style="text-emphasis: filled; font-family: 'Vast Shadow';">Audios for Practice</h1> 
        </div>
    </div>


    <!-- Audio Upload -->
    <!-- <div class="container">
    <h2> Upload Audios </h2>

    <form action="{{ route('audios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" id="type" name="type" required>
            <option value="breathwork">Breathwork</option>
            <option value="meditation">Meditation</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="audio" class="form-label">Audio File</label>
        <input type="file" class="form-control" id="audio" name="audio" accept="audio/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>
</form>
</div> -->





<figure class="text-center m-5">
    <h1> Breathwork Audios </h1>
  <blockquote class="blockquote">
    <p>Breath is the bridge which connects life to consciousness, which unites your body to your thoughts.</p>
  </blockquote>
  <figcaption class="blockquote-footer">
   <cite title="Source Title">Thich Nhat Hanh</cite>
  </figcaption>
</figure>
    <div class="row">
        @foreach($breathworkAudios as $audio)
        <div class="col-md-4 mb-4">
            <div class="card text-center" style="background-image: url('{{ asset('storage/Audios_3.png') }}');">
                <!-- <img src="{{asset('storage/Meditation.jpg')}}" class="card-img-top" alt="Audio Image"> -->
                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.5)">
                    <h3 class="card-title"><u>{{ $audio->title }}</u></h3>
                    <p class="card-text">{{ $audio->description }}</p>
                    <!-- Add Plyr audio player here -->  
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary play-btn" data-audio="{{ asset('storage/audio/' . $audio->file_path) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
  <path d="M10.804 8 5 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
</svg></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    <figure class="text-center m-5">
    <h1> Meditation Audios </h1>
  <blockquote class="blockquote">
    <p>Meditation is a silent heart, a peaceful mind which can make life more lovable.</p>
  </blockquote>
  <figcaption class="blockquote-footer">
   <cite title="Source Title">Sri Chinmoy</cite>
  </figcaption>
</figure>
    <div class="row">
        @foreach($meditationAudios as $audio)
        <div class="col-md-4 mb-4">
            <div class="card text-center" style="background-image: url('{{ asset('storage/Audios_2.jpg') }}');">
                <!-- <img src="{{asset('storage/Meditation.jpg')}}" class="card-img-top" alt="Audio Image"> -->
                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.5)">
                    <h3 class="card-title"><u>{{ $audio->title }}</u></h3>
                    <p class="card-text">{{ $audio->description }}</p>
                    <!-- Add Plyr audio player here -->
                </div>
                <div class="card-footer" style="background-color: rgba(255, 255, 255, 0.5)">
                    <button class="btn btn-primary play-btn" data-audio="{{ asset('storage/audio/' . $audio->file_path) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
  <path d="M10.804 8 5 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
</svg></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>


<audio class="js-player" id="player" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: #fff; padding: 10px;">
<source id="audio-source" src=""></source>
</audio> 

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



        <!-- <audio class="js-player">
<source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.mp3"/>
</audio> -->
<script>
    // Get all Play buttons
    const playButtons = document.querySelectorAll('.play-btn');

    // Add event listener to each Play button
    playButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Get the audio source path from the data attribute
            const audioSource = button.dataset.audio;

            // Set the source of the audio player
            const audioPlayer = document.getElementById('player');
            const sourceElement = document.getElementById('audio-source');
            sourceElement.src = audioSource;
            
            // Load and play the new audio source
            audioPlayer.load();
            audioPlayer.play();
        });
    });
</script>



</body>
</html>





