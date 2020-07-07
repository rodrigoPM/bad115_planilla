<?php namespace App\Models;

use CodeIgniter\Model;

class VistaBoletaModel extends Model
{
    protected $table      = 'vista_boleta';
    protected $primaryKey = 'ID_MOV_BOLETA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['liquido','SALARIO','id_empleado','ID_PLANILLA','CODIGO','ID_SUB_SECCION',
    'nombre_c','direccion','telefonos','NUMERO_DOCUMENTO','NOMBRE_CONCEPTO',
    'TIPO','MONTO'


];


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

    function distintos()
    {
    $boletas=new VistaBoletaModel();
       return $this->distinct('nombre_c','NUMERO_DOCUMENTO')->where('codigo','ME-202008')->get(); 
       
    }

    
}