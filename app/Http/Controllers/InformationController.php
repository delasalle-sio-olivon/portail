<?php
  
namespace App\Http\Controllers;

use App\Categorie;
use App\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class InformationController extends Controller{
  
    public function index(){
  
        $Information  = Information::all();
  
        return response()->json($Information);
  
    }

    public function getInformation($unix){
        $Information  = Information::where('unix', $unix)->first();
        if(isset($Information->id)){
            return response()->json($Information);
        }
        return response("null");
    }
 
    public function createInformation(Request $request){
        if($request->has('unix') && $request->has('titre') &&  $request->has('resume') && $request->has('detail')){
            $Information = Information::create($request->all());
            return response()->json($Information->id);
        }
        return response()->json('failed');
    }

    public function updateInformation(Request $request){
        if($request->has('id') && $request->has('unix') && $request->has('titre') &&  $request->has('resume')){
            $Information  = Information::where('id',$request->input('id'))->first();
            if(isset($Information->id)){
                $Information->unix = $request->input('unix');
                $Information->titre = $request->input('titre');
                $Information->resume = $request->input('resume');
                $Information->detail = $request->input('detail');
                $Information->save();
        
                return response()->json('updated');
            }else{
                $Information = Information::create($request->all());
                return response()->json('updated');
            }
        }
        return response()->json('failed');
    }

    public function deleteInformation($id){
        $Information  = Information::where('id', $id)->first();
        if(isset($Information->id)){
            DB::table('informations_parents')->where('idEnfant', '=', $Information->id)->delete();
            $Information->delete();
            return response()->json('deleted');
        }
        return response()->json('failed');        
    }

    public function getCategorieEnfantsInformations($unix){
        $CategorieParent = Categorie::where('unix', $unix)->first();
        if(isset($CategorieParent->id)){
            $Informations  = Information::join("informations_parents", "idEnfant", '=', 'id')->where('idParent', '=', $CategorieParent->id)->get();
            return response()->json($Informations);
        }
        return response()->json("failed");
    }

    public function createCategorieEnfantsInformations($unix, $unixEnfant){
        $CategorieParent = Categorie::where('unix', $unix)->select('id')->first();
        $Information = Information::where('unix', $unixEnfant)->select('id')->first();
        if(isset($Information->id) && isset($CategorieParent->id)){
            DB::table('informations_parents')->insert(
                ['idParent' => $CategorieParent->id, 'idEnfant' => $Information->id]
            );
            return response()->json('posted');
        }
        return response()->json('failed');
    }

    public function deleteCategorieEnfantsInformations($unix, $unixEnfant){
        $CategorieParent = Categorie::where('unix', $unix)->select('id')->first();
        $Information = Information::where('unix', $unixEnfant)->select('id')->first();
        if(isset($Information->id) && isset($CategorieParent->id)){
            DB::table('informations_parents')->where('idParent', '=', $CategorieParent->id)->where('idEnfant', '=', $Information->id)->delete();
            return response()->json('deleted');
        }
        return response()->json('failed');
    }
}
?>