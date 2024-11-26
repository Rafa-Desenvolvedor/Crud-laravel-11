<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;
    
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $produto = Produto::latest()->paginate(5);
          
        return view('produto.index', compact('produto'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produto.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoStoreRequest $request): RedirectResponse
    {   
        Produto::create($request->validated());
           
        return redirect()->route('Produto.index')
                         ->with('success', 'Produto created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Produto $produto): View
    {
        return view('produto.show',compact('produto'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto): View
    {
        return view('produto.edit',compact('produto'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutotUpdateRequest $request, Produto $produto): RedirectResponse
    {
        $produto->update($request->validated());
          
        return redirect()->route('produto.index')
                        ->with('success','Produto updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();
           
        return redirect()->route('produto.index')
                        ->with('success','Produto deleted successfully');
    }
}