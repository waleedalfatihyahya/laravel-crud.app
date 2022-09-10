<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //Add image
    public function addImage(){
        return view('add_image');
    }
    //Store image
    public function storeImage(){
       /*Logic to store data*/
    }
		//View image
    public function viewImage(){
        return view('view_image');
    }
}
