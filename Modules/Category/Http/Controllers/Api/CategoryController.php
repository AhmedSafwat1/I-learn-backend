<?php

namespace Modules\Category\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\WokerResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\Category\Repositories\Api\CategoryRepository as Category;

class CategoryController extends ApiController
{

    function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function categories(Request $request)
    {
        $categories =  $this->categories->getAllCategories($request);

        return CategoryResource::collection($categories);
    }

    public function users(Request $request, $id){
        // dd($request->countryCode("965"));
        $category = $this->categories->findById($id);
        if(!$category) return $this->notFoundResponse();
        // dd($category->toArray());
        $users = $this->categories->users($category, $request);
        return $this->responsePagnation(
            WokerResource::collection($users)
        );
    }
}
