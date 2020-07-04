<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        if(session()->get('LOGUEADO') == true) {
            return redirect()->to(base_url() . '/dashboard');
        }
        $data = [
            'url' => base_url()
        ];
        return view('login', $data);
    }

    public function inicio() 
    {
        $usuario = $this->request->getPost('USUARIO');
        $contrasenia = $this->request->getPost('CONTRASENIA');

        $user = $this->existe($usuario, $contrasenia);

        if(isset($user))
        {
            if(password_verify($this->request->getPost('CONTRASENIA'), $user['CONTRASENIA']) == true) {
                if($user['ACTIVO'] == 1) {
                    $this->setUserMethod($user);
                    return redirect()->to(base_url() . '/dashboard');
                }
                else {
                    session()->setFlashdata('msg_error', 'Usuario inactivo. Contacte al administrador');
                    return redirect()->to(base_url() . '/login');
                }
            } else {
                if (session()->get('ATTEMPT') == 0) {
                    $data = [
                        'ID_USUARIO'    => $user["ID_USUARIO"],
                        'ATTEMPT'       => 0,
                    ];
                    session()->set($data);
                }
                if(session()->get('ID_USUARIO') == $user["ID_USUARIO"]) {
                    $attempt = session()->get('ATTEMPT') + 1;
                    session()->set('ATTEMPT', $attempt);
                } else {
                    session()->set('ATTEMPT', 1);
                    session()->set('ID_USUARIO', $user["ID_USUARIO"]);
                }

                if(session()->get('ATTEMPT') > 2)
                {
                    $db = \Config\Database::connect();
                    $db->query("UPDATE USUARIOS SET ACTIVO = 0 WHERE USUARIOS.ID_USUARIO = ".$db->escape($user["ID_USUARIO"]));
                    session()->setFlashdata('msg_error', 'Cuenta Bloqueada. Ha superado el máximo de intentos permitidos');
                    return redirect()->to(base_url() . '/login');
                }
                session()->setFlashdata('msg_error', 'Usuario o Contraseña incorrectos!!');
                return redirect()->to(base_url() . '/login');
            }  
        }
        else{
            session()->setFlashdata('msg_error', 'Usuario o Contraseña incorrectos');
            return redirect()->to(base_url() . '/login');
        }
    }

    public function existe(string $usuario, string $contrasenia)
    {
        $user = (new UsuariosModel())->where('USUARIO', $usuario)->first();
        if (isset($user)) {
            return $user; 
        } else {
            return NULL;
        }
    }


    private function setUserMethod($user)
    {
    	$data = [
            'ID_USUARIO'    => $user['ID_USUARIO'],
    		'ID_ROL'		=> $user['ID_ROL'],
    		'NOMBRES'		=> $user['NOMBRES'],
    		'APELLIDOS'		=> $user['APELLIDOS'],
    		'USUARIO'		=> $user['USUARIO'],
    		'LOGUEADO'	    => true,
    	];

    	session()->set($data);
    	return true;
    }

    public function logout()
    {
        $data = [
            'ID_ROL',
            'NOMBRES',
            'APELLIDOS',
            'USUARIO',
            'LOGUEADO',
        ];
        session()->remove($data);
        session()->setFlashdata('msg_cierre', 'Ha cerrado sesión exitosamente!');
        return redirect()->to(base_url() . '/login');
    }

    public function unauthorized()
    {
        session()->stop();
        session()->setFlashdata('msg_error', 'No autorizado!');
        return redirect()->to(base_url() . '/login');
    }

    public function recuperar()
    {
        return redirect()->to(base_url() . '/recuperar_contrasenia');
    }

}