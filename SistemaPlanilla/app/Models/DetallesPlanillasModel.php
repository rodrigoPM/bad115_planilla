<?php namespace App\Models;

use CodeIgniter\Model;

class DetallesPlanillasModel extends Model
{
	protected $table 			= 'DETALLES_PLANILLAS';
	protected $primaryKey 		= 'ID_DETALLE_PLANILLA';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'ID_PLANILLA', 'ID_TIPO_CONTRATACION_DETALLE', 
                                    'SALARIO_ORDINARIO_DETALLE','DIAS_VACACIONES', 'DIAS_SIN_SUELDO',
                                    'HORAS_DIARIAS', 'DIAS_LABORADOS', 'ID_SUB_SECCION_DETALLE',
                                    'SALARIOS', 'HORAS_EXTRA', 'VACACIONES',
                                    'COMISIONES', 'BONIFICACIONES', 'OTROS_INGRESOS',
                                    'SEGURO_SOCIAL','AFP','RENTA',
                                    'PRESTAMOS_BANCO','FONDO_SOCIAL_VIVIENDA','OTROS_DESCUENTOS',
                                    'SALARIO_LIQUIDO_DETALLE'];

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

    function get_destalles($id_planilla){
        return $this->where('ID_PLANILLA', $id_planilla)->findAll();
    }
    function dias($id_empleado)
    {

        return $this->select('DIAS_LABORADOS')->where('ID_EMPLEADO',$id_empleado)->get();
    }
}