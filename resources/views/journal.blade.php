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
        <script>
        // Wait for the DOM to be ready
        document.addEventListener('DOMContentLoaded', function () {
            // After the DOM is loaded, wait for 3 seconds and then fade out the success alert
            setTimeout(function () {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.transition = 'opacity 1s';
                    successAlert.style.opacity = '0';
                    setTimeout(function () {
                        successAlert.remove();
                    }, 1000);
                }
            }, 3000); // 3000 milliseconds = 3 seconds
        });
        </script>
        @endif

    @isset ($journalEntry)

    <div class="accordion" id="journalAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#journalFormCollapse" aria-expanded="true" aria-controls="journalFormCollapse">
                <h2> Update Journal Entry </h2>
            </button>
        </h2>
        <div id="journalFormCollapse" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#journalAccordion">
            <div class="accordion-body">
            <form action="{{ route('journal.update', $journalEntry->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dropdown menu for mood selection -->
                    <div class="mb-3">
                        <label for="moodSelect" class="form-label">How are you feeling?</label>
                        <select class="form-select" id="moodSelect" name="mood_id">
                            <option selected disabled>Select mood</option>
                            <!-- Loop through pre-existing moods to populate options -->
                            @isset($moods)
                            @foreach($moods as $mood)
                                <option value="{{ $mood->id }}" {{ $mood->id == $journalEntry->mood_id ? 'selected' : '' }}>{{ $mood->name }}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- Rich text editor for journal entry -->
                    <div class="mb-3">
                        <label for="journalEntry" class="form-label">Journal Entry</label>
                        <textarea class="form-control" id="journalEntry" name="journal_entry" rows="5">{{ $journalEntry->entry_text }}</textarea>
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
                        <input type="text" class="form-control" id="tagsInput" name="tags" value="{{ implode(',', $journalEntry->tags->pluck('name')->toArray()) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


    @endisset


       

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
                            @isset($moods)
                            @foreach($moods as $mood)
                                <option value="{{ $mood->id }}">{{ $mood->name }}</option>
                            @endforeach
                            @endisset
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

@isset ($journalEntries)

<div class="accordion" id="existingJournalEntries">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h2> Existing Journal Entries </h2>
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#existingJournalEntries">
            <div class="accordion-body" style="max-height: 600px; overflow-y: auto;">
            <div class="accordion-body">
                <!-- Search Bar -->
                <div class="container">
                    <form action="{{ route('journal.search') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search diary entries..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
                    </form>
                </div>

                <!-- Display Journal Entries -->
                @if ($journalEntries->isEmpty())
                
                    <div class="alert alert-info">No Results Found</div>
                    <a href="{{ route('journal.index') }}" class="btn btn-primary">Go Back</a>
                
                @else 
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
                            <!-- Delete button -->
                            <form action="{{ route('journal.delete', $entry->id) }}" method="POST" class="float-end m-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                                
                            <a href="{{ route('journal.edit', ['id' => $entry->id]) }}" >
                             <button type="button" class="btn btn-primary float-end btn-sm m-1">Update</button>
                            </a>


                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
                
        </div>
    </div>
</div>

@endisset

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





