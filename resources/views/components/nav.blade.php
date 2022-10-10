<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($items as $item)
            <li class="nav-item {{ Route::is($item['active'])? 'active' : ''}}">
                <a  href="{{route($item['route'])}}"   class="nav-link " >
                <i class="{{$item['icon']}}"></i>
                <span class="menu-title">{{$item['title']}}</span>
                </a>
            </li>
        @endforeach

    </ul>
</nav>
