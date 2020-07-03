<?php namespace App\Models;

use CodeIgniter\Model;

class IngresosDescuentosModel extends Model
{
	protected $table 			= 'CATALOGO_INGRESOS_DESCUENTOS';
	protected $primaryKey 		= 'ID_CODIGO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_TIPO_MOVIMIENTO',
									'NOMBRE_CONCEPTO',
									'APLICA_SEGURO',
									'APLICA_AFP',
									'APLICA_RENTA',
									'TIPO',
									'PREFIJO'];

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

	function get_nombre_concepto($id){
        $movimiento = $this->find($id);
        return $movimiento['NOMBRE_CONCEPTO'];
	}

	function get_ingresos(){
		return $this->where('TIPO', 1)->where('ID_CODIGO !=', 1)->findAll();

	}
	function get_descuentos(){
		return $this->where('TIPO', 2)->whereNotIn('ID_CODIGO', ['2', '3', '4'])->findAll();
	}
	
	function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $movimiento = $this->select('ID_CODIGO')
                ->like('NOMBRE_CONCEPTO', $termino)
                ->findAll();
        $id_string = (count($movimiento) != 0)? []:['0'];
        for ($i=0; $i < count($movimiento); $i++) { 
            $id_string[count($id_string)] = strval($movimiento[$i]['ID_CODIGO']);
        }
        return $id_string;
    }
}