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
                        <a href="{{ url('/affirmations') }}" >Affirmations</a>
                        <a href="{{route('habit.tracker')}}" class="active">Habit Tracker</a>
                        
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
             <h1 class="display-3" style="text-emphasis: filled; font-family: 'Vast Shadow';">Your Habit Tracker</h1> 
        </div>
    </div>

    <!-- Add New Habit Form -->
    @isset($habits)
    <div class="container">
    <h2 class="mt-5 mb-4">Add New Habit</h2>
<div class="card m-3">
    <!-- <div class="card-header">
        Add New Habit
    </div> -->
    <div class="card-body">
        <form action="{{ route('habits.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Habit Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Habit</button>
        </form>
    </div>
</div>
</div>
@endisset

@if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @isset($habits)
    <div class="container">
    <h2 class="mt-5 mb-4">Habit Tracker for the Current Week</h2>
    
    @if($habits->isEmpty())
        <p>No habits added yet.</p>
    @else
        <form id="habit-form" action="{{ route('habits.update') }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table habit table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Habit</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                    <th scope="col">Saturday</th>
                    <th scope="col">Sunday</th>
                </tr>
            </thead>
            <tbody>
                @foreach($habits as $habit)
                    @if($habit->is_active)
                        <tr>
                            <td>{{ $habit->habit_name }}</td>
                            <!-- <td><input type="checkbox" name="monday"></td>
                            <td><input type="checkbox" name="tuesday"></td>
                            <td><input type="checkbox" name="wednesday"></td>
                            <td><input type="checkbox" name="thursday"></td>
                            <td><input type="checkbox" name="friday"></td>
                            <td><input type="checkbox" name="saturday"></td>
                            <td><input type="checkbox" name="sunday"></td> -->
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][monday]"  {{ $habit->monday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][tuesday]"  {{ $habit->tuesday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][wednesday]" {{ $habit->wednesday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][thursday]" {{ $habit->thursday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][friday]" {{ $habit->friday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][saturday]" {{ $habit->saturday ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="habits[{{ $habit->id }}][sunday]" {{ $habit->sunday ? 'checked' : '' }}></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
    @endif
    @endisset
</div>

@isset($habits)
<div class="container">
    <h2 class="mt-5 mb-4">Modify Habits</h2>
    <div class="card m-3">
        <div class="card-body">
            <form action="{{ route('habits.deactivate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="habit_id" class="form-label">Select Habit to Deactivate:</label>
                    <select class="form-select" id="habit_id" name="habit_id">
                        <option value="" selected disabled>Select Habit</option>

                        @foreach($habits as $habit)
                            <option value="{{ $habit->id }}">{{ $habit->habit_name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Deactivate Habit</button>
            </form>
        </div>
        @isset($inactiveHabits)
        <div class="card-body">
        <form action="{{ route('habits.reactivate') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="habit" class="form-label">Select Habit to Reactivate</label>
                <select class="form-select" id="habit" name="habit_id" required>
                    <option value="" selected disabled>Select Habit</option>
                    
                        @foreach($inactiveHabits as $habit)
                    <option value="{{ $habit->id }}">{{ $habit->habit_name }}</option>
                        @endforeach
                    
                </select>
            </div>
            @endisset
            <button type="submit" class="btn btn-primary">Reactivate Habit</button>
        </form>
        </div>
    </div>
</div>
@endisset

@isset($weekStartDates)
<div class="container">
    <h2 class="mt-5 mb-4">Retrieve Previous Records</h2>
    <form action="{{ route('habits.showWeek') }}" method="GET">
        <div class="mb-3">
            <label for="week">Select Week Start Date:</label>
            <select class="form-select" name="week" id="week" required>
                <option value="" selected disabled>Select Week Start Date</option>
                @foreach($weekStartDates as $startDate)
                    <option value="{{ $startDate }}">{{ $startDate }}</option>
                @endforeach
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Show Habits</button>
    </form>
    @endisset
    @isset($habitsForWeek)
    @if($habitsForWeek->isEmpty())
        <p>No habits added for this week.</p>
    @else
    <h2 class="mt-5 mb-4">Habit Tracker for Selected Week</h2>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Habit</th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
        </tr>
    </thead>
    <tbody>
        @foreach($habitsForWeek as $habit)
        <tr>
            <td>{{ $habit->habit_name }}</td>
            <td><input type="checkbox" {{ $habit->monday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->tuesday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->wednesday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->thursday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->friday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->saturday ? 'checked' : '' }} disabled></td>
            <td><input type="checkbox" {{ $habit->sunday ? 'checked' : '' }} disabled></td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-primary btn-lg" href="{{route('habit.tracker')}}" style ="margin:5px;"role="button">Go Back</a>

    @endif
    @endisset
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
</head>
