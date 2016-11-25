<?php
  
namespace App\Http\Controllers;
  
use App\Categorie;
use App\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

  
class ImageController extends Controller{
  
    public function addImage(Request $request, $unix){
        if ($request->hasFile('img') && isset($unix)) {
            $request->img->storeAs('/dossier_img', $unix);
        }
    }

    public function updateImage(Request $request, $unix)
    {
        if ($request->hasFile('img') && isset($unix)) {
            $request->img->storeAs('/dossier_img', $unix);
        }
    }

    public function deleteImg(Request $request, $unix)
    {
        
    }
}
?>