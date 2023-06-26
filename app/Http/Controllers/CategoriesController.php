<?php

namespace App\Http\Controllers;

use App\Category;
use App\Follower;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function getOrganizationCategories(Request $request, $organization_id)
    {

        $categories = $this->categories
            ->where('state', 1)
            ->whereHas('books', function ($query) use ($organization_id) {
                $query->with(['categories' => function($query) use ($organization_id){
                    $query->select(['id', 'title']);
                    $query->where('organization_id', $organization_id);
                }]);

                return $query->select('id', 'title', 'slug');
            })
            ->select(['id', 'title'])
            ->distinct('id')
            ->skip($request->limit)
            ->take(2)
            ->get();

        //return $categories;
        $returnHTML = view(currentFrontView('partials.categories.filter'))->with(['categories' => $categories])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function getPersonCategories(Request $request, $person_id)
    {

        $categories = $this->categories
            ->where('state', 1)
            ->whereHas('books', function ($query) use ($person_id) {
                $query->with(['categories' => function($query) use ($person_id){
                    $query->select(['id', 'title']);
                    $query->where('person_id', $person_id);
                }]);
                return $query->select('id', 'title', 'slug');
            })
            ->select(['id', 'title'])
            ->distinct('id')
            ->skip($request->limit)
            ->take(2)
            ->get();

        //return $categories;
        $returnHTML = view(currentFrontView('partials.categories.filter'))->with(['categories' => $categories])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }


    public function view(Request $request, $id, $slug)
    {

        $category = $this->categories
            ->where([['state', 1], ['id', $id]])
            ->select(['id', 'title', 'slug', 'thumbnail', 'description'])
            ->first();

        // \DB::enableQueryLog();
        $folow = Follower::where([['category_id', $id], ['folower_id', auth()->id()]])->first();
        //return \DB::getQueryLog();
         //return $folow;
        $child_categories = $this->categories
            ->where([['state', 1], ['parent_id', $id]])
            ->select(['id', 'title', 'slug', 'thumbnail'])
            ->take(10)
            ->get();
        // return \DB::getQueryLog();
        return view(currentFrontView('categories.view'), compact('category', 'folow','child_categories'));
    }

    public function getAwardCategories(Request $request, $award_id)
    {

        $categories = $this->categories
            ->where('state', 1)
            ->whereHas('books', function ($query) use ($award_id) {
                $query->with(['awards' => function($query) use ($award_id){
                    $query->select(['id', 'title']);
                    $query->where('award_id', $award_id);
                }]);

                return $query->select('id', 'title', 'slug');
            })
            ->select(['id', 'title'])
            ->distinct('id')
            ->skip($request->limit)
            ->take(2)
            ->get();

        //return $categories;
        $returnHTML = view(currentFrontView('partials.categories.filter'))->with(['categories' => $categories])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function search(Request $request)
    {
        //url()->full();
        $limit = getConstant('frontend.alphabetLimit');
        $title = '';
        $alphabet = '';
        if (!empty($request->alphabet)) {
            $alphabet = $request->alphabet;
            if ($alphabet=='الف') $alphabet = 'ا';
        }
        $categories = $this->categories
            ->select(['id', 'title', 'slug'])
            ->where('state', 1);

        if (!empty($request->title)) {
            $categories = $categories->where('title', 'like', '%'.$request->title . '%');
            $title = $request->title;
        }
        if (!empty($request->alphabet)) {
            $categories = $categories->where('title', 'like', $alphabet . '%');
        }
        $categories = $categories->orderBy('title', 'asc');
        $categories = $categories->paginate($limit);

        return view(currentFrontView('categories.search'), compact('categories', 'title', 'alphabet'));
    }
}
