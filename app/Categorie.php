<?php
namespace App;
  
use Illuminate\Database\Eloquent\Model;
  
class Categorie extends Model
{
     
     protected $fillable = ['titre', 'unix', 'resume', 'detail'];
     
}
?>