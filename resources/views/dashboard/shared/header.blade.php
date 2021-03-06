@inject('menu', 'App\MenuBuilder\FreelyPositionedMenus')


<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
    <a class="c-header-brand d-sm-none" href="#">
        <img class="c-header-brand" src="{{ asset('/assets/brand/coreui-base.svg') }}"
             width="97" height="46" alt="Exibir menu">
    </a>
    <button class="c-header-toggler c-class-toggler ml-md-3 d-md-down-none" type="button"
            data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <span class="c-header-toggler-icon"></span>
    </button>
    @if($top_menu)
        {{ $menu->render($top_menu, 'c-header-', 'd-md-down-none') }}
    @endif
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                <svg class="c-icon">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-bell') }}"></use>
                </svg>
            </a>
        </li>
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                <svg class="c-icon">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-list-rich') }}"></use>
                </svg>
            </a></li>
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                <svg class="c-icon">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-envelope-closed') }}"></use>
                </svg>
            </a>
        </li>

        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('/assets/img/avatars/1.jpg') }}"
                                           alt="fmesturini@gmail.com"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-bell') }}"></use>
                    </svg>
                    Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-envelope-open') }}"></use>
                    </svg>
                    Messages<span class="badge badge-success ml-auto">42</span></a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-task') }}"></use>
                    </svg>
                    Tasks<span class="badge badge-danger ml-auto">42</span></a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-comment-square') }}"></use>
                    </svg>
                    Comments<span class="badge badge-warning ml-auto">42</span></a>
                <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                <a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-user') }}"></use>
                    </svg>
                    Profile</a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-settings') }}"></use>
                    </svg>
                    Settings</a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-credit-card') }}"></use>
                    </svg>
                    Payments<span class="badge badge-secondary ml-auto">42</span></a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-file') }}"></use>
                    </svg>
                    Projects<span class="badge badge-primary ml-auto">42</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-lock-locked') }}"></use>
                    </svg>
                    Lock Account</a><a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-account-logout') }}"></use>
                    </svg>
                    <form action="{{ asset('/logout') }}" method="POST"> @csrf
                        <button type="submit" class="btn btn-ghost-dark btn-block">Logout</button>
                    </form>
                </a>
            </div>
        </li>
    </ul>

    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php $segments = ''; ?>
            @for($menu = 1; $menu <= count(Request::segments()); $menu++)
                <?php $segments .= '/' . Request::segment($menu); ?>
                @if($menu < count(Request::segments()))
                    <li class="breadcrumb-item">{{ Request::segment($menu) }}</li>
                @else
                    <li class="breadcrumb-item active">{{ Request::segment($menu) }}</li>
                @endif
            @endfor
        </ol>
    </div>
</header>
