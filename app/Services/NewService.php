<?php
namespace App\Services;

use App\Models\NewModel;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class NewService {

	public function getListNews(){
        $news = [];
		NewModel::notExpired()
                ->orderByDesc('created_at')
                ->chunk(100, function ($dataNews) use (&$news) {
                    foreach ($dataNews as $dataNew) {
                        $news[] = $dataNew;
                    }
                });
        return $news;
	}

	public function recursiveCategorySearch(Category $category, $expired = false)
    {
        $news = ($expired)? $category->news()->notExpired()->get() :$category->news;

        $subCategories = $category->subCategories;

        foreach ($subCategories as $subCategory) {
            $news = $news->merge($this->recursiveCategorySearch($subCategory));
        }

        return $news;
    }

    public function getNewsFromRecursiveCategories($category){
    	$news = $this->recursiveCategorySearch($category, true);
    	return $news;
    }

    public function create($dataNew)
    {
        $new = DB::transaction(function () use ($dataNew) {
                
            return NewModel::create($dataNew);

         });
        return $new;
    }

    public function update($new, $dataNew)
    {
        DB::transaction(function () use ($new, $dataNew) {
                
            $new->update($dataNew);

         });
        return $new;
    }

    public function delete($new)
    {
        DB::transaction(function () use ($new) {
                
            $new->delete();

         });
        return $new;
    }
} 