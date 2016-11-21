<?php
  
namespace App\Http\Controllers;
  
use App\Categorie;
use App\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

  
class LinkController extends Controller{
  
    public function categories(){
        $links = DB::table('categories_parents')->get();
        return response()->json($links);
    }
    
    public function updateAllCats(Request $request){    

        DB::delete('delete from categories_parents');
        foreach($request->all() as $link){
            DB::insert('insert into categories_parents (idParent, idEnfant) values (?, ?)', [$link['idParent'], $link['idEnfant']]);
        }

        return response()->json();
    }


    public function informations(){
        $links = DB::table('informations_parents')->get();
        return response()->json($links);
    }
    
    public function updateAllInfos(Request $request){    

        DB::delete('delete from informations_parents');
        foreach($request->all() as $link){
            DB::insert('insert into informations_parents (idParent, idEnfant) values (?, ?)', [$link['idParent'], $link['idEnfant']]);
        }
        
        return response()->json("updated");
    }

    public function addLinkCat(Request $request){
        if($request->has('unixParent') && $request->has('unixEnfant')){
            $CategorieParent  = Categorie::where('unix', $request->input('unixParent'))->first();
            $CategorieEnfant  = Categorie::where('unix', $request->input('unixEnfant'))->first();
            if(isset($CategorieParent) && isset($CategorieEnfant)){
                DB::insert('insert into categories_parents (idParent, idEnfant) values (?, ?)', [$CategorieParent->id, $CategorieEnfant->id]);
                return response()->json("posted");
            }
        }
        return response()->json("failed");
    }

    public function addLinkInfo(Request $request){
        if($request->has('unixParent') && $request->has('unixEnfant')){
            $CategorieParent  = Categorie::where('unix', $request->input('unixParent'))->first();
            $Information  = Information::where('unix', $request->input('unixEnfant'))->first();
            if(isset($CategorieParent) && isset($Information)){
                DB::insert('insert into informations_parents (idParent, idEnfant) values (?, ?)', [$CategorieParent->id, $Information->id]);
                return response()->json("posted");
            }
        }
        return response()->json("failed");
    }

}
?>