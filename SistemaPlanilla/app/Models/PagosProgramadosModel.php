<?php namespace App\Models;

use CodeIgniter\Model;

class PagosProgramadosModel extends Model
{
	protected $table 			= 'PAGOS_PROGRAMADOS';
	protected $primaryKey 		= 'ID_MOVIMIENTO_PAGO';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'ID_CODIGO', 'VALOR_CUOTA_PAGO', 
                                    'FECHA_INICIO_PAGO','FECHA_FIN_PAGO', 'ACTIVO_PAGO'];

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