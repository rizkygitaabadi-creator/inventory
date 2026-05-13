<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected ItemService $svc;

    public function __construct(ItemService $svc) {
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
            'message' => 'Berhasil menarik semua data Item'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $req)
    {
        $item = $this->svc->create($req->validated());
        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil dibuat'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $item = $this->svc->find($id);
            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Berhasil menarik satu data Item'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $req, $id) {$item = $this->svc->update($id, $req->validated());
        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->svc->delete($id);
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Item berhasil dihapus'
        ], 204);
    }
}
