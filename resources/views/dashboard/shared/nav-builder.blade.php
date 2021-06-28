<?php

if (!function_exists('renderDropdown')) {
    function renderDropdown($data)
    {
        if (array_key_exists('slug', $data) && $data['slug'] === 'dropdown') {
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if ($data['hasIcon'] === true && $data['iconType'] === 'coreui') {
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown($data['elements']);
            echo '</ul></li>';
        } else {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['slug'] === 'link') {
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                } elseif ($data[$i]['slug'] === 'dropdown') {
                    renderDropdown($data[$i]);
                }
            }
        }
    }
}
?>

<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ asset('/assets/brand/coreui-base-white.svg') }}" width="118" height="46"
         alt="Empresa Logo">
    <img class="c-sidebar-brand-minimized" src="{{ asset('assets/brand/coreui-signet-white.svg') }}" width="118"
         height="46" alt="Empresa Logo">
</div>

<ul class="c-sidebar-nav">
    @if($side_menu)
        @foreach($side_menu as $menu)
            @if($menu['slug'] === 'link')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ url($menu['href']) }}">
                        @if($menu['hasIcon'] === true)
                            @if($menu['iconType'] === 'coreui')
                                <i class="{{ $menu['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                        {{ $menu['name'] }}
                    </a>
                </li>
            @elseif($menu['slug'] === 'dropdown')
                <?php renderDropdown($menu) ?>
            @elseif($menu['slug'] === 'title')
                <li class="c-sidebar-nav-title">
                    @if($menu['hasIcon'] === true)
                        @if($menu['iconType'] === 'coreui')
                            <i class="{{ $menu['icon'] }} c-sidebar-nav-icon"></i>
                        @endif
                    @endif
                    {{ $menu['name'] }}
                </li>
            @endif
        @endforeach
    @endif
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>

