<?php
  
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class PortailController extends Controller{
  
    public function index(){
  
        return view('front/index');
  
    }
}
?>