    <div class="container">
        <ul class="pull-left">
          <li><a href="{{ URL::route('Home', null) }}">Home</a></li>  
          <li><a href="{{ URL::route('View', null) }}">Commute</a></li>
          <li><a href="{{ URL::route('Home', null) }}">Hop</a></li>
        </ul>
        <ul class="pull-right">
          <li>
            @if (Auth::check())
                <a href="{{ URL::route('Login', null) }}">
                  Log In
                </a>
            @else
                <a href="{{ URL::route('Logout', null) }}">
                  Logout
                </a>
            @endif
          </li>
          <li><a href="#">Help</a></li>
        </ul>
      </div>