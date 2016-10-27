<?php
  
namespace App\Http\Controllers;
  
use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

  
class CategorieController extends Controller{
  
    public function index(){
        $Categorie  = Categorie::all();
        return response()->json($Categorie);
    }

    public function getCategorie($unix){
        $Categorie  = Categorie::where('unix', $unix)->first();
        if(isset($Categorie->id)){
            return response()->json($Categorie);
        }
        return response()->json('failed');
    }
 
    public function createCategorie(Request $request){
        if($request->has('unix') && $request->has('titre') &&  $request->has('resume') && $request->has('detail')){
            $Categorie = Categorie::create($request->all());
            return response()->json('posted');
        }
        return responde()->json('failed');
    }

    public function updateCategorie(Request $request, $unix){
        if($request->has('unix') && $request->has('titre') &&  $request->has('resume') && $request->has('detail')){
            $Categorie  = Categorie::where('unix', $unix)->first();
            if(isset($Categorie->id)){
                $Categorie->unix = $request->input('unix');
                $Categorie->titre = $request->input('titre');
                $Categorie->resume = $request->input('resume');
                $Categorie->detail = $request->input('detail');
                $Categorie->save();
        
                return response()->json('updated');
            }
        }
        return response()->json('failed');

    }

    public function deleteCategorie($unix){
        $Categorie  = Categorie::where('unix', $unix)->first();
        if(isset($Categorie->id)){
            $Categorie->delete();
        return response()->json('deleted');
        }
        return response()->json('failed');
    }

    
    public function getCategorieEnfantsCategories($unix){
        $CategorieParent = Categorie::where('unix', $unix)->first();
        if(isset($CategorieParent->id)){
            $Categories  = Categorie::join("categories_parents", "idEnfant", '=', 'id')->where('idParent', '=', $CategorieParent->id)->get();
            if(isset($Categorie->id)){
                return response()->json($Categories);
            }
        }
        return response()->json('failed');
    }
    
    public function createCategorieEnfantsCategories($unix, $unixEnfant){
        $CategorieParent = Categorie::where('unix', $unix)->select('id')->first();
        $Categorie = Categorie::where('unix', $unixEnfant)->select('id')->first();
        if(isset($Categorie->id) && isset($CategorieParent->id)){
            DB::table('categories_parents')->insert(
                ['idParent' => $CategorieParent->id, 'idEnfant' => $Categorie->id]
            );
            return response()->json('posted');
        }
        return response()->json('failed');
    }
    
    public function deleteCategorieEnfantsCategories($unix, $unixEnfant){
        $CategorieParent = Categorie::where('unix', $unix)->select('id')->first();
        $Categorie = Categorie::where('unix', $unixEnfant)->select('id')->first();
        if(isset($Categorie->id) && isset($CategorieParent->id)){
            DB::table('categories_parents')->where('idParent', '=', $CategorieParent->id)->where('idEnfant', '=', $Categorie->id)->delete();
            return response()->json('deleted');
        }
        return response()->json('failed');
    }
}
?>