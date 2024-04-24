<?php

namespace App\Http\Controllers;

use App\Models\NewModel;
use App\Http\Requests\StoreNewModelRequest;
use App\Http\Requests\UpdateNewModelRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\NewService;
use App\Models\category;


class NewController extends Controller
{
    function __construct(NewService $newService){
        $this->newService = $newService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewModelRequest $request)
    {
        try {
            return response()->render(
                [
                    'status' => 'created',
                    'message' => 'news successfully created',
                    'data' => $this->newService->create($request->all()),
                ]
            );
        } catch (QueryException $e) {
            return response()->render([
                'status' => 'error',
                'message' => 'new creation probleme',
                'errors' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(NewModel $newModel)
    {
        return response()->render(
                [
                    'status' => 'success',
                    'message' => 'news successfully retuned',
                    'data' => $newModel,
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewModel $newModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateNewModelRequest $request, NewModel $newModel)
    public function update(Request $request, NewModel $newModel)
    {
        try {
            return response()->render(
                [
                    'status' => 'updated',
                    'message' => 'news successfully updated',
                    'data' => $this->newService->update($newModel, $request->all()),
                ]
            );
        } catch (QueryException $e) {
            return response()->render([
                'status' => 'error',
                'message' => 'new updating probleme',
                'errors' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewModel $newModel)
    {
        try {
            $this->newService->delete($newModel);
            /**
             * Empty return 204 error
             * */
            return response()->render([
                    'status' => 'deleted',
                    'message' => 'news successfully deleted',
                ]);
        } catch (QueryException $e) {
            return response()->render([
                'status' => 'error',
                'message' => 'new deleting probleme',
                'errors' => $e->getMessage()
            ]);
        } 
    }

    public function newsList(Request $request)
    {
        $news = Cache::remember('newsList', 30, function () {
            return $this->newService->getListNews();
        });

        return response()->render(
            [
                'status' => 'success',
                'message' => 'news successfully listed',
                'data' => $news,
            ]
        );
    }

    public function recursiveSearch(Request $request)
    {

        return response()->render(
            [
                'status' => 'success',
                'message' => 'news successfully listed',
                'data' => $this->newService->recursiveCategorySearch(Category::find(1)),
            ]
        );
    }

    public function searchByCategory(string $category_name)
    {
        $category = Category::whereTitle($category_name)->first();
        $response = [
                    'status' => 'not_found',
                    'message' => 'category not found',
                ];
        if($category){
            $news = Cache::remember(`newBy${category_name}Category`, 30, function () use($category) {
                return $this->newService->getNewsFromRecursiveCategories($category);
            });
            $response = [
                    'status' => 'success',
                    'message' => 'news successfully listed',
                    'data' => $news,
                ];
        }
        return response()->render($response);
    }
}
