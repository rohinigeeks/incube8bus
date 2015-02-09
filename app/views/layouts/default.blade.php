<!DOCTYPE html>
<html>
    <head>
        @include('includes.head') 
    </head>
  <body>
    <div class="nav">
      @include('includes.header')
    </div>
    @yield('content')   
  </body>
</html>