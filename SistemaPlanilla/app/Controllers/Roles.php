<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\RolesModel;
use App\Models\MenusModel;
use App\Models\PermisosModel;



class Roles extends BaseController
{
    protected function data_vista($operacion = '', $exito = false, $roles = [], $termino = '')
    {
        $roles  = ($roles == []) ? (new RolesModel())->get() : $roles;

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
            'menus'         => $menus,
            'roles'         => $roles,
            'operacion'     => $operacion,
            'exito'         => $exito,
            'nombre_obj'    => 'Rol',
            'termino'       => $termino,
            'url_guardar'   => base_url() . '/roles/guardar',
            'url_eliminar'  => base_url() . '/roles/eliminar',
            'url_buscar'    => base_url() . '/roles/buscar',
        ];
        return crear_head('Roles')
            . crear_body(
                view('roles/roles', $data),               //main
                '',                                           //sidebar
                crear_breadcrumb('Roles', crear_ruta_breadcrumb('Roles')),   //breadcrumb
                ['roles/roles.js']
            );
    }

    public function index()
    {
        return $this->data_vista();
    }

    public function guardar()
    {
        if ($this->request->getMethod() == 'post') {
            $exito = false;
            if ($this->validate([
                'NOMBRE_ROL'   => 'required|string'
            ])) {
                (new RolesModel())->save([
                    'ID_ROL'        => $this->request->getVar('ID_ROL'),
                    'NOMBRE_ROL'    => $this->request->getVar('NOMBRE_ROL')
                ]);

                $nombre = $this->request->getVar('NOMBRE_ROL');

                $idrol = (new RolesModel())->where('NOMBRE_ROL', $nombre)->first();

                foreach( $_POST['menu'] as $permiso ) {

                    (new PermisosModel())->save([
                        'ID_PERMISO'    => $this->request->getVar('ID_PERMISO'),
                        'ID_ROL'        => $idrol["ID_ROL"],
                        'ID_MENU'       => $permiso
                    ]);

                }
                $exito = true;
            }
            return $this->data_vista('guardar', $exito);

        }
        return redirect()->to(base_url() . '/roles');
    }

    public function eliminar()
    {
        if ($this->request->getMethod() == 'post') {
            $exito = false;
            if ($this->validate([
                'ID_ROL'   => 'required|numeric'
            ])) {
                (new RolesModel())->where('ID_ROL', $this->request->getVar('ID_ROL'))->delete();
                $exito = true;
            }
            return $this->data_vista('eliminar', $exito);
        }
        return redirect()->to(base_url() . '/roles');
    }

    public function buscar()
    {
        if ($this->request->getMethod() == 'post') {
            $exito = false;
            $termino = '';
            $roles = [];
            if ($this->validate([
                'termino'   => 'required|string'
            ])) {
                $termino = trim($this->request->getVar('termino'));
                if ($termino != '') {
                    $roles = (new RolesModel())
                        ->like('NOMBRE_ROL', $termino)
                        ->findAll();
                }
                $exito = (count($roles) == 0) ? false : true;
            }
            return $this->data_vista('buscar', $exito, $roles, $termino);
        }
        return redirect()->to(base_url() . '/roles');
    }
}
