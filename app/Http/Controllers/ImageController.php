<?php
  
namespace App\Http\Controllers;
  
use App\Categorie;
use App\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
  
class ImageController extends Controller{
  
    public function addImage(Request $request, $id){
        if ($request->hasFile('img') && isset($unix)) {
            echo'a';
            $request->img->storeAs('./dossier_img', $unix);
        }
    }

    public function updateImage(Request $request,$id)
    {

        if ($request->hasFile('file') && isset($id)) {
            echo $request->file('file');
            Image::make($request->file('file'))->save('../resources/views/front/app/ressource/images/informations/'.$id.'.png');
            //Image::make($request->file('file'))->save('../resources/views/front/app/ressource/images/informations/'.$id.'.mini.png');
        }
    }

    public function deleteImg(Request $request, $id)
    {
        
    }
}
?>