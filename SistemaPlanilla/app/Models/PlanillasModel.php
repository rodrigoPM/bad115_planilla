<?php namespace App\Models;

use CodeIgniter\Model;

class PlanillasModel extends Model
{
	protected $table 			= 'PLANILLAS';
	protected $primaryKey 		= 'ID_PLANILLA';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_ESTATUS', 'ID_PERIOCIDAD', 'CODIGO', 
                                    'DESDE_FECHA','HASTA_FECHA', 'FECHA_PLANILLA',
                                    'FECHA_CIERRE', 'ID_USUARIO_CIERRE'];

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

    
    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $planillas = $this->select('ID_PLANILLA')
                ->like('CODIGO', $termino)
                ->findAll();
        $id_string = (count($planillas) != 0)? []:['0'];
        for ($i=0; $i < count($planillas); $i++) { 
            $id_string[count($id_string)] = strval($planillas[$i]['ID_PLANILLA']);
        }
        return $id_string;
    }

    function ultima_planila(){
        return $this->orderBy('ID_PLANILLA', 'desc')->first();
    }

    function get_id_planilla_by_codigo($codigo){
        return ($this->select('ID_PLANILLA')->where('CODIGO', $codigo)->get())[0]['ID_PLANILLA'];
    }
    function get_codigo_by_id($id){
        return ($this->find($id)['CODIGO']);
    }

    function get_codigo($periodo, $fecha){
        $planilla_codigos = $this->select('CODIGO')
                ->where('ID_PERIOCIDAD', $periodo)
                ->Where('DESDE_FECHA', $fecha)->get();

        if(count($planilla_codigos) != 1){
            return '';
        }

        return $planilla_codigos[0]['CODIGO'];
    }

    function get_planillas_abiertas(){
        return $planillas = $this->where('ID_ESTATUS !=', 2)->findAll();
    }

    function get_estatus($id){
        return ($this->find($id))['ID_ESTATUS'];
    }

}