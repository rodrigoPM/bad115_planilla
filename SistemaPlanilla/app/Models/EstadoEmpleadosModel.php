<?php namespace App\Models;

use CodeIgniter\Model;

class EstadoEmpleadosModel extends Model
{
    protected $table      = 'ESTADO_EMPLEADOS';
    protected $primaryKey = 'ID_ESTADO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTADO', 'AFECTA_CALCULO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function get($id = ''){
        if($id == '' || $id == []){
            return $this->findAll();
        }else if(is_array($id)){
            return $this->find($id);
        }else{
            return [$this->find($id)];
        }
    }

    function get_nombre($id){
        return ($this->find($id))['NOMBRE_ESTADO'];
    }

    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $estados = $this->select('ID_ESTADO')
                ->like('NOMBRE_ESTADO', $termino)
                ->findAll();
        $id_string = (count($estados) != 0)? []:['0'];
        for ($i=0; $i < count($estados); $i++) { 
            $id_string[count($id_string)] = strval($estados[$i]['ID_ESTADO']);
        }
        return $id_string;
    }
}