<?php

// date_default_timezone_set ('America/El_Salvador');
setlocale(LC_ALL, 'es_SV'); 

function crear_plantilla($main = ''){
    return crear_head().crear_body($main);
}

function crear_head(
    $titulo = 'Sin Backup',
    $estilos    = []
){
    $datos = [
        'titulo' => $titulo,
        'estilos'=> $estilos,
    ];
    return view('plantilla/head', $datos);
}

function crear_body(
        $main = '',
        $sidebar = '',
        $breadcrumb = '',
        $scripts = [],
        $navbar = '',
        $footer = ''
    ){
    $navbar = ($navbar == '') ? crear_navbar() : $navbar;
    $breadcrumb = ($breadcrumb == '') ? crear_breadcrumb() : $breadcrumb;
    $sidebar = ($sidebar == '') ? crear_sidebar() : $sidebar;
    $main = ($main == '') ? '<h1>Sin Contenido</h1>' : $main;
    $footer = ($footer == '') ? crear_footer() : $footer; 

    $datos = [
        'navbar'     => $navbar,
        'breadcrumb' => $breadcrumb,
        'sidebar'    => $sidebar,
        'main'       => $main,
        'footer'     => $footer,
        'scripts'    => $scripts,
    ];
    return view('plantilla/body', $datos);
}

function crear_navbar(
    $enlaces = [],
    $fecha = ''
){
    if($fecha == ''){
        $fecha =  strftime("%A, %d de %B de %Y",  strtotime(date('Y-m-d')));
    }
    if(count($enlaces) == 0){
        $enlaces = [[
            'nombre' => 'Casa',
            'url' => base_url()
        ]];
    }
    $datos = [
        'enlaces' => $enlaces,
        'fecha' => $fecha,
    ];
    return view('plantilla/navbar', $datos);
}

function crear_breadcrumb(
    $titulo  = 'Dashboard',
    $ruta = []
){
    if(count($ruta) == 0){
        $ruta = [[
                'nombre' => 'Dashboard',
                'url' => base_url()
            ],[
                'nombre' => 'Casa',
                'url' => base_url()
            ]];
    }
    $datos = [
        'titulo' => $titulo,
        'ruta' => $ruta,
    ];
    return view('plantilla/breadcrumb', $datos);
}

function crear_sidebar(
    $usuario = [],
    $menus = []
){
    if(count($usuario) == 0){
        $usuario = [
            'nombre' => session()->get('NOMBRES') .' '. session()->get('APELLIDOS'),
            'img'    => 'user2-160x160.jpg',
            'url'    => base_url()
        ];
    }
    if(count($menus) == 0){
        /*
        $menus = [
            [
                'nombre'   => 'Empresa',
                'url'      => base_url(),
                'icono'    => 'fas fa-building',
                'submenus' => [
                    [
                        'nombre'   => 'Datos Empresa',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Unidades',
                        'url'      => base_url().'/'.'unidades/'
                    ],
                    [
                        'nombre'   => 'Departamentos',
                        'url'      => base_url().'/'.'Departamentos_empresa/'
                    ],
                    [
                        'nombre'   => 'Area',
                        'url'      => base_url().'/'.'Area/'
                    ],
                    [
                        'nombre'   => 'Secciones',
                        'url'      => base_url().'/'.'Secciones/'
                    ],                    [
                        'nombre'   => 'Subsecciones',
                        'url'      => base_url().'/'.'Subsecciones/'
                    ],
                ]
            ],
            [
                'nombre'   => 'Planilla',
                'url'      => base_url(),
                'icono'    => 'fas fa-copy',
                'submenus' => [
                    [
                        'nombre'   => 'Boleta de pago',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'ISSS, AFP',
                        'url'      => base_url()
                    ],
                ]
            ],
            [
                'nombre'   => 'Empleados',
                'url'      => base_url(),
                'icono'    => 'fas fa-address-card',
                'submenus' => [
                    [
                        'nombre'   => 'Datos Empleados',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Nuevo Empleado',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Tipo de contratacion',
                        'url'      => base_url().'/Tipos_contratacion'
                    ],
                    [
                        'nombre'   => 'Puestos de trabajo',
                        'url'      => base_url().'/Puestos_trabajo'
                    ],
                    [
                        'nombre'   => 'Profesiones',
                        'url'      => base_url().'/profesiones'
                    ],

                    
                ]
            ],
            [
                'nombre'   => 'Usuario',
                'url'      => base_url(),
                'icono'    => 'fas fa-users-cog',
                'submenus' => [
                    [
                        'nombre'   => 'Roles Y permisos',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Activar y desactivar',
                        'url'      => base_url()
                    ],
                ]
            ]
            ];
            */

        $db = \Config\Database::connect();
        $rol = session()->get('ID_ROL');

        $query = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_ICONO, MENUS.NOMBRE_MENU, ICONOS.NOMBRE_ICONO
            FROM menus
            INNER JOIN ICONOS ON iconos.ID_ICONO = menus.ID_ICONO
            INNER JOIN permisos ON MENUS.ID_MENU = permisos.ID_MENU
            INNER JOIN roles ON permisos.ID_ROL = roles.ID_ROL
            WHERE roles.ID_ROL = ". $db->escape($rol) ." AND menus.ID_MENU_PADRE IS NULL");

        foreach($query->getResult() as $query) {
            $submenus = $db->query(" 

                SELECT MENUS.ID_MENU, MENUS.ID_MENU_PADRE, MENUS.NOMBRE_MENU, MENUS.ID_ICONO, MENUS.RUTA_MENU , iconos.NOMBRE_ICONO 
                FROM menus
                INNER JOIN iconos ON MENUS.ID_ICONO = iconos.ID_ICONO
                INNER JOIN permisos ON MENUS.ID_MENU = permisos.ID_MENU
                INNER JOIN roles ON permisos.ID_ROL = roles.ID_ROL
                WHERE MENUS.ID_MENU_PADRE = ". $db->escape($query->ID_MENU) ." 
                AND permisos.ID_ROL = ". $db->escape($rol) ."
               
            ");

            $menus["$query->ID_MENU"] = array(
                'NOMBRE_MENU'   => $query->NOMBRE_MENU,
                'ID_ICONO'      => $query->ID_ICONO,
                'NOMBRE_ICONO'  => $query->NOMBRE_ICONO,
            );

            foreach ($submenus->getResult() as $submenu) {
                $menus["$query->ID_MENU"]["submenus"]["$submenu->ID_MENU"] = array(
                    "NOMBRE_MENU"   => $submenu->NOMBRE_MENU,
                    "ID_ICONO"      => $submenu->ID_ICONO,
                    "NOMBRE_ICONO"  => $submenu->NOMBRE_ICONO,
                    "ID_MENU_PADRE" => $submenu->ID_MENU_PADRE,
                    "RUTA_MENU"     => $submenu->RUTA_MENU,
                );
            }

        }

    }
    $datos = [
        'usuario' => $usuario,
        'menus'  => $menus
    ];
    return view('plantilla/sidebar', $datos);
}

function crear_footer(
    $grupo = 'Sin Backup',
    $materia = 'BAD115'

){
    $datos = [
        'grupo' => $grupo,
        'materia' => $materia
        
    ];
    return view('plantilla/footer', $datos);
}

