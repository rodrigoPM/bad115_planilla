<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckRole implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        
        if (session()->get('ID_USUARIO') != 1) {

            $db = \Config\Database::connect();
            $uri = service('uri');

            $last = $request->uri->getTotalSegments();
            $record_num = $request->uri->getSegment($last);
            $rol = session()->get('ID_ROL');

            $query = $db->query("SELECT MENUS.RUTA_MENU FROM menus
                INNER JOIN permisos ON permisos.ID_MENU = MENUS.ID_MENU
                INNER JOIN roles ON roles.ID_ROL = permisos.ID_ROL
                WHERE menus.RUTA_MENU = ". $db->escape($record_num) ." 
                AND ROLES.ID_ROL = ". $db->escape($rol) ."
            ");

            $row = $query->getRow();

            if(!isset($row)) {
                return redirect()->to(base_url() . '/login/unauthorized');
            }
			
		}
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}