<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::with(['category', 'tags'])->orderBy('id','desc')->paginate(7);
        
        return response()->json(compact('portfolios'));
    }
    public function show($slug){
        $portfolio = Portfolio::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json(compact('portfolio'));
        
    }
}

