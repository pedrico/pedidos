<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse ">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span style="color: #ffffff;">
                    @if( auth()->user()->profile_images()->count() > 0)                        
                        <img alt="image" class="img-circle" src="/upload/{{auth()->user()->profile_images[auth()->user()->profile_images()->count()-1]->name}}.jpg" style="width: 100px; height: 100px" />
                        @else
                        <i class="fa fa-user-circle fa-5x"></i>
                        @endif
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}} {{auth()->user()->last_name}}</strong>
                            </span> <span class="text-muted text-xs block">
                                @foreach(auth()->user()->roles as $rol) <span class="badge badge-info">{{$rol->name}}</span>@endforeach
                                <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('profile.index')}}">{{__('Perfil')}} </a></li>
                        <li><a href="contacts.html">{{__('Direcciones')}}</a></li>
                        <li><a href="mailbox.html">{{__('Métodos de pago')}}</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Cerrar sesión') }}</a>
                            <form id="logout-form-side" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
                <div class="logo-element">
                    <img src="{{asset('img/logo_white.png')}}" alt="Picapino" width="80%">
                </div>
            </li>
            @if(auth()->user()->hasRoles(['Admin']))
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Administrador</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('users.index')}}">Usuarios</a></li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('product_category.index')}}">Categoría de productos</a></li>
                </ul>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Supervisor</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('users.index')}}">Usuarios</a></li>
                </ul>
            </li>
            @endif
            <!-- <li class="landing_link">
                <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a>
            </li> -->
        </ul>

    </div>
</nav>