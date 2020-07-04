<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\MenusModel;

class Dashboard extends BaseController
{

	public function index()
	{
		return crear_plantilla(view('index'));
	}
	
	//--------------------------------------------------------------------
	
}
