<?php namespace App\Models;

use CodeIgniter\Model;

class EventosModel extends Model
{
    protected $table      = 'EVENTOS';
    protected $primaryKey = 'ID_EVENTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['FECHA_INICIO', 'FECHA_FIN', 'TITULO'];


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

    function last_evento_id(){
        return ($this->selectMax('ID_EVENTO')->get())[0]['ID_EVENTO'];
    }
}