<header>
        <div class="container-fluid position-relative no-side-padding">

            <a href="#" class="logo"><h4 style="font-weight: bolder;">BLOG</h4></a>

            <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

            <ul class="main-menu visible-on-click" id="main-menu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('posts.index')}}">Post</a></li>
                @guest
                   <li><a href="{{route('login')}}">login</a></li>
                   <li><a href="{{route('register')}}">Register</a></li>
                @else
                     @if(Auth::user()->role->id==1)
                     <li><a href="{{route('admin.dashbord')}}">Dashbord</a></li>
                     @elseif(Auth::user()->role->id==2)
                     <li><a href="{{route('author.dashbord')}}">Dashbord</a></li>
                     @endif

                @endguest
            </ul><!-- main-menu -->

            <div class="src-area">
                <form method="GET" action="{{route('search')}}">
                    <button class="src-btn" type="submit"><i class="material-icons">search</i></button>
                    <input class="src-input" type="text" name="query" placeholder="Type of search" value="{{isset($query)  ? $query:''}}">
                </form>
            </div>

        </div><!-- conatiner -->
    </header>