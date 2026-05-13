<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $svc;
    public function __construct(CategoryService $svc)
    {
        $this->svc = $svc;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
'status' => 'success',
'data' => $this->svc->all(),
'message' => 'Berhasil menarik semua data Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $req)
    {
        $cat = $this->svc->create($req->validated());
return response()->json([
'status' => 'success',
'data' => $cat,
'message' => 'Kategori berhasil dibuat'
], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
$cat = $this->svc->find($id);
return response()->json([
'status' => 'success',
'data' => $cat,
'message' => 'Berhasil menarik satu data kategori']);
} catch (\Exception $e) {
return response()->json([
'status'=>'error',
'data'=>null,
'message'=>$e->getMessage()
], 404);
}
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $req, $id)
    {
        $cat = $this->svc->update($id, $req->validated());
return response()->json([
'status' => 'success',
'data' => $cat,
'message' => 'Kategori berhasil diperbarui'
]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->svc->delete($id);
return response()->json([
'status' => 'success',
'data' => null,
'message' => 'Kategori berhasil dihapus'
],204);
    }
}
