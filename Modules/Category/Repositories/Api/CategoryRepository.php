<?php

namespace Modules\Category\Repositories\Api;

use Modules\Category\Entities\Category;

class CategoryRepository
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories($request)
    {
        $categories = $this->category->mainCategories()
                                    ->active()
                                    ->with("allChildren")
                                    ->orderBy("sort", "asc")
                                    ->orderBy('id', 'DESC')
                                    ->get();
        return $categories;
    }

    public function findById($id, $with=[]){
        return $this->category->active()->find($id);
    }

    public function users(&$category, &$request)
    {
        $users = $category->users()
                ->active()
                ->when($request->lat && $request->lng , function($query) use(&$request){
                    $query->distance($request->lat, $request->lng ) 
                    ->orderByRaw("distance asc");
                    ; //29.37958,47.990231
                })
                ->when($request->search , function($query) use(&$request){
                    $query->searchFilter($request);
                    ; //29.37958,47.990231
                })
                ->with(["categories"])
                ->orderBy("created_at", "desc")
                ->paginate($request->page_count ?? env("PAGE_COUNT", 15)); 
        return $users;
    }
}
