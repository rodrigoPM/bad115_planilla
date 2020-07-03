<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\RolesModel;
use App\Models\MenusModel;
use App\Models\PermisosModel;


class Roles extends BaseController
{
    protected $nombre_clase = 'roles';

    public function index()
    {
        $roles = new RolesModel();
        //$menus = (new MenusModel())->get();

        $datos= $roles->paginate(10);

        $db = \Config\Database::connect();
        $rol = session()->get('ID_ROL');

        $query = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_ICONO, MENUS.NOMBRE_MENU, ICONOS.NOMBRE_ICONO
                FROM MENUS
                INNER JOIN ICONOS ON ICONOS.ID_ICONO = MENUS.ID_ICONO
                WHERE MENUS.ID_MENU_PADRE IS NULL");
        foreach($query->getResult() as $query) {
                $submenus = $db->query(" 

                    SELECT MENUS.ID_MENU, MENUS.ID_MENU_PADRE, MENUS.NOMBRE_MENU, MENUS.ID_ICONO, MENUS.RUTA_MENU , ICONOS.NOMBRE_ICONO 
                    FROM MENUS
                    INNER JOIN ICONOS ON ICONOS.ID_ICONO = MENUS.ID_ICONO
                    WHERE MENUS.ID_MENU_PADRE = ". $db->escape($query->ID_MENU) ."
                ");

                $menus["$query->ID_MENU"] = array(
                    'ID_MENU'       => $query->ID_MENU,
                    'NOMBRE_MENU'   => $query->NOMBRE_MENU,
                    'ID_ICONO'      => $query->ID_ICONO,
                    'NOMBRE_ICONO'  => $query->NOMBRE_ICONO,
                );

                foreach ($submenus->getResult() as $submenu) {
                    $menus["$query->ID_MENU"]["submenus"]["$submenu->ID_MENU"] = array(
                        "ID_MENU"       => $submenu->ID_MENU,
                        "NOMBRE_MENU"   => $submenu->NOMBRE_MENU,
                        "ID_ICONO"      => $submenu->ID_ICONO,
                        "NOMBRE_ICONO"  => $submenu->NOMBRE_ICONO,
                        "ID_MENU_PADRE" => $submenu->ID_MENU_PADRE,
                        "RUTA_MENU"     => $submenu->RUTA_MENU,
                    );
                }
            }

       
        $data = [
            'roles' =>$datos,
            'menus' =>$menus,
            'paginador'=>$roles->pager
        ];
        return crear_plantilla(view('roles/roles', $data));
    }

    public function view($par ='')
    {
        $roles = new RolesModel();
        $menus = (new MenusModel())->get();
        $datos = $roles->paginate(10);
        if ($par==''){
            $data = [
                'roles' => $datos
            ];

            return view('roles/busqueda', $data);


        }else{

            $datos = $roles->like('NOMBRE_ROL',strtoupper($par))->paginate(10);
            $data['roles'] = $datos;
            return view('roles/busqueda', $data);
        }


    }
    public function delete($id = NULL)
    {
        $roles = new RolesModel();
        $roles->delete($id);
        $data = [
            'roles' => $roles->get()
        ];
        return view('roles/busqueda', $data);
    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        (new RolesModel())->save([
            'ID_ROL' => strtoupper($this->request->getVar('ID_ROL')),
            'NOMBRE_ROL' =>strtoupper( $this->request->getVar('NOMBRE_ROL'))
        ]);

        $rol = $this->request->getVar('ID_ROL');
        foreach($this->request->getVar('menu[]') as $menu)
        {
            (new PermisosModel())->save([
                'ID_ROL'    => $rol,
                'ID_MENU'   => $menu,
            ]);
        }
        $roles = new RolesModel();
        $data = [
           'roles' => $roles->get()
       ];
   
       
      return view('roles/busqueda', $data);
    }

}
