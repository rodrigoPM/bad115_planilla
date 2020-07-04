<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\MenusModel;

class Dashboard extends BaseController
{

	public function index()
	{
		$db = \Config\Database::connect();
        $menus = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_ICONO, MENUS.NOMBRE_MENU FROM MENUS
			INNER JOIN PERMISOS ON MENUS.ID_MENU = PERMISOS.ID_MENU
			INNER JOIN ROLES ON PERMISOS.ID_ROL = ROLES.ID_ROL
			WHERE ROLES.ID_ROL = 1 AND MENUS.ID_MENU_PADRE IS NULL");

        $submenus = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_MENU_PADRE, MENUS.NOMBRE_MENU, MENUS.ID_ICONO, MENUS.RUTA_MENU FROM MENUS
			WHERE MENUS.ID_MENU_PADRE = 1");

		$menus = (new MenusModel())->get();

		return crear_plantilla(view('index', $menus));
	}
	
	//--------------------------------------------------------------------
	
}
