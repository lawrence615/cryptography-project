<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Laravel</title>

   <link href="/css/materialize.css" rel="stylesheet">
   <link href="/css/style.css" rel="stylesheet">

   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
</head>
<body>
     <nav class="white" role="navigation">
        <div class="nav-wrapper container">
          <a id="logo-container" href="/" class="brand-logo">Logo</a>
          <ul class="right hide-on-med-and-down">
           @if (Auth::guest())
                          <li><a href="/auth/login">Login</a></li>
                          <li><a href="/auth/register">Register</a></li>
                       @else
                             <a href="#!" class="dropdown-button" data-activates="logout-dropdown">{{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a>
                             <ul id="logout-dropdown" class="dropdown-content">
                                <li><a href="/auth/logout">Logout</a></li>
                             </ul>
                       @endif
          </ul>

          <ul id="nav-mobile" class="side-nav">
            <li><a href="#">Navbar Link</a></li>

            @if (Auth::guest())
                           <li><a href="/auth/login">Login</a></li>
                           <li><a href="/auth/register">Register</a></li>
                        @else
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                 <li><a href="/auth/logout">Logout</a></li>
                              </ul>
                           </li>
                        @endif
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>

   @yield('content')


   <footer class="page-footer teal">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text">Company Bio</h5>
              <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Settings</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Connect</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
          Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
          </div>
        </div>
      </footer>

   <!-- Scripts -->
    <script src="/js/jquery-2.1.1.min.js"></script>
      <script src="/js/materialize.js"></script>
      <script src="/js/init.js"></script>
</body>
</html>