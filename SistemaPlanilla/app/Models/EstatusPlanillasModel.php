<?php namespace App\Models;

use CodeIgniter\Model;

class EstatusPlanillasModel extends Model
{
    protected $table      = 'ESTATUS_PLANILLAS';
    protected $primaryKey = 'ID_ESTATUS';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTATUS','CODIGO_ESTATUS','ESTATUS_PLANILLA'];


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
        
        $estatus = $this->find($id);
        return $estatus['NOMBRE_ESTATUS'];
    }
}