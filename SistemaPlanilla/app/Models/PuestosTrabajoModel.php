<?php namespace App\Models;

use CodeIgniter\Model;

class PuestosTrabajoModel extends Model
{
    protected $table      = 'PUESTOS_TRABAJO';
    protected $primaryKey = 'ID_PUESTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['DESCRIPCION_PUESTO','SALARIO_MIN','SALARIO_MAX'];


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

    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $puestos = $this->select('ID_PUESTO')
                ->like('DESCRIPCION_PUESTO', $termino)
                ->findAll();
        $id_string = (count($puestos) != 0)? []:['0'];
        for ($i=0; $i < count($puestos); $i++) { 
            $id_string[count($id_string)] = strval($puestos[$i]['ID_PUESTO']);
        }
        return $id_string;
    }

}