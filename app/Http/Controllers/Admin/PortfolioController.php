<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $portfolios = Portfolio::where('title','like',"%$search%")->paginate(8);
        }else{
            $portfolios = Portfolio::orderby('id', 'desc')->paginate(8);
        }
        $direction = 'desc';
        return view('admin.portfolio.index', compact('portfolios', 'direction'));
    }

    public function category_portfolio(){

        $categories = category::all();

        return view('admin.portfolio.category_portfolio', compact('categories'));
    }

    public function orderby($column, $direction)
    {
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $portfolios = Portfolio::orderby($column, $direction)->paginate(8);

        return view('admin.portfolio.index', compact('portfolios', 'direction'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        $tags = Tag::all();
        return view('admin.portfolio.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortfolioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortfolioRequest $request)
    {
        $portfolio_data = $request->all();
        $portfolio_data['slug'] = Portfolio::generateSlug($portfolio_data['title']);


        if (array_key_exists('image', $portfolio_data)) {
            
            $portfolio_data['original_name'] = $request->file('image')->getClientOriginalName();

            $portfolio_data['image'] = Storage::put('upload', $portfolio_data['image']);
        }


        //dd($portfolio_data);
        $new_portfolio = new Portfolio();
        $new_portfolio->fill($portfolio_data);

        $new_portfolio->save();

        if (array_key_exists('tags', $portfolio_data)) {
            $new_portfolio->tags()->attach($portfolio_data['tags']);
        }

        return redirect()->route('admin.portfolio.show', $new_portfolio)->with('message', 'File aggiunto correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('admin.portfolio.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $categories = category::all();
        $tags = Tag::all();
        return view('admin.portfolio.edit', compact('portfolio', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePortfolioRequest  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $portfolio_data = $request->all();
        if($portfolio_data['title'] != $portfolio->title){
            $portfolio_data['slug'] = Portfolio::generateSlug($portfolio_data['title']);
        }else{
            $portfolio_data['slug'] = $portfolio->slug;
        }

        if (array_key_exists('image', $portfolio_data)) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $portfolio_data['original_name'] = $request->file('image')->getClientOriginalName();

            $portfolio_data['image'] = Storage::put('upload', $portfolio_data['image']);
        }
        $portfolio->update($portfolio_data);

        if (array_key_exists('tags', $portfolio_data)) {
            $portfolio->tags()->sync($portfolio_data['tags']);
        }else{
            //Array vuoto a Sync() === detach()
            $portfolio->tags()->sync([]);
        }

        return redirect()->route('admin.portfolio.show', $portfolio)->with('message', 'File aggiornato correttamente');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {

    // Senza cascadeOnDelete() nella migration, qui toccherebbe fare il detach() di $portfolio->tags
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();
        
        
        return redirect()->route('admin.portfolio.index')->with('deleted', 'File eliminato');

    }
}
