<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;
use App\Models\CambioContraseniaModel;

class Recuperar_contrasenia extends BaseController
{
    public function index()
    {
        if(session()->get('LOGUEADO') == true) {
            return redirect()->to(base_url() . '/dashboard');
        }
        $data = [
            'url' => base_url()
        ];
        return view('recuperar_contrasenia', $data);
    }

    public function enviar()
    {
        
    }

}