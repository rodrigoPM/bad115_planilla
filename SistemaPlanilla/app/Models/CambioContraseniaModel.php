<?php namespace App\Models;

use CodeIgniter\Model;

class CambioContraseniaModel extends Model
{
	protected $table 			= 'CAMBIO_CONTRASENIA';
	protected $primaryKey 		= 'NUEVA_CONTRASENIA';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_USUARIO',
                                    'FECHAHORAMODIFICACION',
                                    'ESTADO_USUARIO'];

	protected $validationRules 		= [];
	protected $validationMessages 	= [];
	protected $skipValidation		= false;
	
	function get($id = ''){
        if($id == '' || $id == []){
            return $this->findAll();
        }else if(is_array($id)){
            return $this->find($id);
        }else{
            return [$this->find($id)];
        }
    }
}