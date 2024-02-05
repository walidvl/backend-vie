<?php

namespace App\Http\Controllers;

use App\Models\InformationEbook;
use App\Http\Requests\StoreInformationEbookRequest;
use App\Http\Requests\UpdateInformationEbookRequest;

class InformationEbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function information($title)
    {
       // book Detail
       $book = InformationEbook::where('title', $title)->first();
       if(!$book){
         return response()->json([
            'message'=>'book Not Found.'
         ],404);
       }

       // Return Json Response
       return response()->json([
          'book' => $book
       ],200);
    }
}
