<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::with(['category', 'tags'])->orderBy('id','desc')->paginate(7);
        
        return response()->json(compact('portfolios'));
    }
    public function show($slug){
        
        
        $portfolio = Portfolio::where('slug', $slug)->with(['category', 'tags'])->first();

        if($portfolio->image){

            $portfolio->image = url("storage/" . $portfolio->image);
        }else{
            $portfolio->image = url("upload/image.png");
        }

        return response()->json(compact('portfolio'));
        
    }
}

