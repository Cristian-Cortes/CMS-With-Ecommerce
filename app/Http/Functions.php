<?php

//Key Value From Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function getModulesArray(){
    $a = [
        '0' => 'Productos',
        '1' => 'Blog'
    ];
    return $a;
}

function getUrlFileFromUploads($file, $size = null){
    if(!is_null($file)):
        $file = json_decode($file, true);
        if($size):
            return url('/uploads/'.$file['path'].'/'.$size.'_'.$file['final_name']);
        else:
            return url('/uploads/'.$file['path'].'/'.$file['final_name']);
        endif;
    endif;
}

function getRoleUserArray($mode, $id){
    $roles = ['0' => 'usuario normal', '1' => 'administrador'];
    if(!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
    endif;
}

function getUserStatusArray($mode, $id){
    $status = ['0' => 'Registrado', '1' => 'Verificado', '100' => 'Baneado'];
    if(!is_null($mode)):
        return $status;
    else:
        return $status[$id];
    endif;
}

function user_permissions(){
    $p = [
        'dashboard' => [
            'icon' => '<i class="fa-solid fa-house-chimney"></i>',
            'title' => 'Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dasboard.',
                'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.',
                'dashboard_sell_today' => 'Puede ver lo facturado hoy.'

            ]
        ],
        'products' => [
            'icon' => '<i class="fa-solid fa-boxes-stacked"></i>',
            'title' => 'Modulo Productos',
            'keys' => [
                'products' => 'Puede ver el listado de productos.',
                'products_add' => 'Puede agregar nuevos productos.',
                'products_edit' => 'Puede editar productos.',
                'products_search' => 'Puede buscar productos.',
                'products_delete' => 'Puede eliminar productos.',
                'products_gallery_add' => 'Puede agregar imagenes a la galeria de productos.',
                'products_gallery_deleted' => 'Puede eliminar imagenes de la galeria de productos.',
                'products_inventory' => 'Puede administrar el inventario de un producto.'
            ]
        ],
        'categories' => [
            'icon' => '<i class="fa-solid fa-folder-open"></i>',
            'title' => 'Modulo Categorias',
            'keys' => [
                'categories' => 'Puede ver el listado de categorias.',
                'categories_add' => 'Puede agregar categorias.',
                'categories_edit' => 'Puede editar categorias.',
                'categories_deleted' => 'Puede eliminar categorias.'
            ]
        ],
        'users' => [
            'icon' => '<i class="fa-solid fa-user-group"></i>',
            'title' => 'Modulo Usuarios',
            'keys' => [
                'users_list' => 'Puede ver el listado de usuarios.',
                'users_view' => 'Puede ver el perfil del usuario.',
                'users_edit' => 'Puede editar usuarios.',
                'users_banned' => 'Puede suspender y reactivar usuarios.',
                'users_permissions' => 'Puede modificar los permisos de usuario.'
            ]
        ],
        'settings' => [
            'icon' => '<i class="fa-solid fa-gears"></i>',
            'title' => 'Modulo de Configuraciones',
            'keys' => [
                'settings' => 'Puede modifcar la configuración.'
            ]
        ],
        'orders' => [
            'icon' => '<i class="fa-solid fa-clipboard-list"></i>',
            'title' => 'Modulo de Ordenes',
            'keys' => [
                'orders_list' => 'Puede ver el listado de órdenes.',
                'orders_view' => 'Puede ver los detalles de una orden.',
                'orders_change_status' => 'Puede cambiar el estado de una orden.'
            ]
        ],
        'sliders' => [
            'icon' => '<i class="fa-regular fa-images"></i>',
            'title' => 'Modulo de Sliders',
            'keys' => [
                'sliders_list' => 'Puede ver la lista de sliders.',
                'sliders_add' => 'Puede agregar sliders.',
                'sliders_edit' => 'Puede editar los sliders.',
                'sliders_delete' => 'Puede eliminar sliders.'
            ]
        ],
        'coverage' => [
            'icon' => '<i class="fas fa-shipping-fast"></i>',
            'title' => 'Cobertura de envíos',
            'keys' => [
                'coverage_list' => 'Puede ver la lista de cobertura de envíos.',
                'coverage_add' => 'Puede agregar zonas de envío.',
                'coverage_edit' => 'Puede editar zonas de envío.',
                'coverage_delete' => 'Puede eliminar zonas de envío.'
            ]
        ]

    ];
    return $p;
}

function geyUserYears(){
    $ya = date('Y');
    $ym = $ya - 10;
    $yo = $ym - 72;
    return [$ym,$yo];
}

function getMonths($mode, $key){
    $m = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];
    if($mode == "list"){
        return $m;
    }else{
        return $m[$key];
    }
}

function getShippingMethod($method = null){
    $status = ['0' => 'Gratis', '1' => 'Valor fijo', '2' => 'Valor variable por ubicación', '3' => 'Envío gratis / Monto minimo'];
    if(is_null($method)):
        return $status;
    else:
        return $status[$method];
    endif;
}

function getCoverageType($type = null){
    $status = ['0' => 'Estado', '1' => 'Ciudad'];
    if(is_null($type)):
        return $status;
    else:
        return $status[$type];
    endif;
}

function getCoverageStatus($status = null){
    $list = ['0' => 'No activo', '1' => 'Activo'];
    if(is_null($status)):
        return $list;
    else:
        return $list[$status];
    endif;
}

function getEnableOrNot($status = null){
    $list = ['0' => 'No activo', '1' => 'Activo'];
    if(is_null($status)):
        return $list;
    else:
        return $list[$status];
    endif;
}

function getPaymentsMethods($method = null){
    $list = ['0' => 'Efectivo', '1' => 'Transferencia o deposito', '2' => 'Paypal', '3' => 'Tarjeta de crédito'];
    if(is_null($method)):
        return $list;
    else:
        return $list[$method];
    endif;
}

function getOrderStatus($status = null){
    $list = ['0' => 'En proceso', 
        '1' => 'Pago pendinete de confirmar', 
        '2' => 'Pago recibido', 
        '3' => 'Procesando orden',
        '4' => 'Orden enviada',
        '5' => 'Lista para recoger',
        '6' => 'Orden entregada',
        '100' => 'Orden rechazada'
    ];
    if(is_null($status)):
        return $list;
    else:
        return $list[$status];
    endif;
}

function getOrderType($type = null){
    $list = ['0' => 'Entrega a domicilio', 
        '1' => 'Recoger en tienda'
    ];
    if(is_null($type)):
        return $list;
    else:
        return $list[$type];
    endif;
}

function number($number){
    return config('cms.currency').' '.number_format($number, 2, '.', ',');
}

function getTemplatesOfPlatform($template = null){
    $list = [
        'default' => 'Default'
    ];
    if(is_null($template)):
        return $list;
    else:
        return $list[$template];
    endif;
}