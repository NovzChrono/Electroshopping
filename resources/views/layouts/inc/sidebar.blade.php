<div class="sidebar" data-color="purple" data-background-color="black" data-image="">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{ route('dashboard') }}" class="simple-text logo-normal">
        ElectroShopping
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}  ">
          <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>Tableau de bord</p>
          </a>
        </li>
        <li class="nav-item {{ Request::is('categories') ? 'active':'' }} ">
            <a class="nav-link" href="{{route('categories')}}">
              <i class="material-icons">category</i>
              <p>Categories</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('vendeurs') ? 'active':'' }} ">
            <a class="nav-link" href="{{route('vendeurs')}}">
              <i class="material-icons">home</i>
              <p>Vendeurs</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('marques') ? 'active':'' }} ">
            <a class="nav-link" href="{{route('marques')}}">
              <i class="material-icons">apple</i>
              <p>Marques</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('materiels') ? 'active':'' }} ">
            <a class="nav-link" href="{{route('materiels')}}">
              <i class="material-icons">inventory2</i>
              <p>Materiels</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('commandes') ? 'active':'' }} ">
            <a class="nav-link" href="{{route('commandes')}}">
              <i class="material-icons">loyalty</i>
              <p>Voir les commandes</p>
            </a>
        </li>
        @if (Auth::user()-> role_as == '2')
          <li class="nav-item {{ Request::is('users') ? 'active':'' }} ">
              <a class="nav-link" href="{{route('users')}}">
                <i class="material-icons">person</i>
                <p>Utilisateurs</p>
              </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
