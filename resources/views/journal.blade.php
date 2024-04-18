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
        <script src="https://cdn.tiny.cloud/1/jt7ituh0txbajv7ktsxb11m9ix19qd6s5wjf2aku0kegihj4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
                        <a href="{{route('affirmations')}}">Affirmations</a>
                        <a href="{{route('habit.tracker')}}">Habit Tracker</a>
                        <a href="{{route('journal.index')}}"  class="active"> Journal </a>
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

        <div class="page_header" style="background-image: url('{{ asset('storage/watercolor.jpg')}}');" >
        <!-- <style> background-image: url('storage/watercolor.jpg'); </style> -->
        <!-- <img src="{{asset('storage/watercolor.jpg')}}"> -->
        
        <div class="container p-3 mb-1">
             <h1 class="display-3" style="text-emphasis: filled; font-family: 'Vast Shadow';">Your Personal Journal</h1> 
        </div>
        </div>

        @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

       

        <div class="accordion" id="journalAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#journalFormCollapse" aria-expanded="true" aria-controls="journalFormCollapse">
                <h2> Add a New Journal Entry </h2>
            </button>
        </h2>
        <div id="journalFormCollapse" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#journalAccordion">
            <div class="accordion-body">
                <form action="{{ route('journal.store') }}" method="POST">
                    @csrf
                    
                    <!-- Dropdown menu for mood selection -->
                    <div class="mb-3">
                        <label for="moodSelect" class="form-label">How are you feeling?</label>
                        <select class="form-select" id="moodSelect" name="mood_id">
                            <option selected disabled>Select mood</option>
                            <!-- Loop through pre-existing moods to populate options -->
                            @foreach($moods as $mood)
                                <option value="{{ $mood->id }}">{{ $mood->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rich text editor for journal entry -->
                    <div class="mb-3">
                        <label for="journalEntry" class="form-label">Journal Entry</label>
                        <textarea class="form-control" id="journalEntry" name="journal_entry" rows="5"></textarea>
                        <script>
                            tinymce.init({
                            selector: '#journalEntry',
                            height: 300,
                            plugins: 'advlist autolink lists link image charmap print preview anchor',
                            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent',
                            menubar: false
                            });
                        </script>
                    </div>

                    
                    
                    <!-- Tags input field -->
                    <div class="mb-3">
                        <label for="tagsInput" class="form-label">Tags (separated by commas)</label>
                        <input type="text" class="form-control" id="tagsInput" name="tags">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="accordion" id="existingJournalEntries">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h2> Existing Journal Entries </h2>
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#existingJournalEntries">
            <div class="accordion-body">
                <!-- Search Bar -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                </div>

                <!-- Display Journal Entries -->
                @foreach($journalEntries as $entry)
                <div class="card journalcard mb-3">
                    <div class="card-header">{{ $entry->created_at->format('jS F Y, h:i A') }}</div>
                    <div class="card-body">
                        <p class="card-text">{!! nl2br(strip_tags($entry->entry_text)) !!}</p>
                    </div>
                    <div class="card-footer">
                        Mood: {{ $entry->mood->name }}
                        <br>
                        Tags:
                            @foreach ($entry->tags as $tag)
                                {{ $tag->name }}
                                    @if (!$loop->last)
                                    ,
                                    @endif
                            @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



        <script>
            // Wait for the DOM to be ready
            $(document).ready(function () {
            // After the DOM is loaded, wait for 3 seconds and then fade out the success alert
            setTimeout(function () {
            $("#success-alert").fadeOut("slow");
            }, 3000); // 3000 milliseconds = 3 seconds
            });
        </script>


</body>
</html>





