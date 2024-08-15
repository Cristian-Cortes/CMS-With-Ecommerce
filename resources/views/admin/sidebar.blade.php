<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('static/img/logo2.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola:</span>
            <div class="name">
                {{ Auth::user()->name}} {{ Auth::user()->lastname}}
                <a href="{{ url('/logout') }}" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Salir">
                    <i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
            <div class="email">
                {{ Auth::user()->email}}
            </div>
        </div>
    </div>
    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'dashboard'))
            <li>
                <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fa-solid fa-house-chimney"></i> Dashboard</a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'categories'))
            <li>
                <a href="{{ url('/admin/categories/0') }}" class="lk-categories lk-categories_add lk-categories_edit lk-categories_deleted">
                    <i class="fa-solid fa-folder-open"></i> Categorias
                </a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'products'))
            <li>
                <a href="{{ url('/admin/products/1') }}" class="lk-products lk-products_add lk-products_search lk-products_edit lk-products_delete products_gallery_add lk-products_gallery_deleted lk-products_inventory">
                    <i class="fa-solid fa-boxes-stacked"></i> Productos
                </a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'orders_list'))
            <li>
                <a href="{{ url('/admin/orders/all/all') }}" class="lk-orders_list lk-orders_view"><i class="fa-solid fa-clipboard-list"></i> Órdenes</a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'coverage_list'))
            <li>
                <a href="{{ url('/admin/coverage') }}" class="lk-coverage_list lk-coverage_add lk-coverage_edit"><i class="fas fa-shipping-fast"></i> Cobertura de envíos</a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'sliders_list'))
            <li>
                <a href="{{ url('/admin/sliders') }}" class="lk-sliders_list lk-sliders_add lk-sliders_edit lk-sliders_delete"><i class="fa-regular fa-images"></i> Sliders</a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'users_list'))
            <li>
                <a href="{{ url('/admin/users/all') }}" class="lk-users_list lk-users_view lk-users_banned lk-users_permissions"><i class="fa-solid fa-user-group"></i> Usuarios</a>
            </li>
            @endif
            @if(kvfj(Auth::user()->permissions, 'settings'))
            <li>
                <a href="{{ url('/admin/settings') }}" class="lk-settings"><i class="fa-solid fa-gears"></i> Configuraciones</a>
            </li>
            @endif
        </ul>
    </div>
</div>