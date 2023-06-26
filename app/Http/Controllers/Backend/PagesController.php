<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\DeletePageRequest;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;
use Ayra\MoveNotPossibleException;

class PagesController extends Controller
{
    protected $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (isset($_REQUEST['search'])) {
            $pages = $this->pages->with('ancestors')
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->orderBy('order', 'desc')
                ->paginate($limit);
        } else {
            $pages = $this->pages->with('ancestors')
                ->orderBy('order', 'desc')
                ->paginate($limit);
        }
        return view(currentBackView('pages.index'), compact('pages'));
    }


    public function create(Page $page)
    {
        $templates = $this->getPageTemplates();
        $orderPages = $this->pages->all();
        $orderList = $this->paddedTitle($orderPages);
        return view(currentBackView('pages.form'), compact('page', 'templates', 'orderList'));
    }

    protected function paddedTitle($orderPages)
    {
        $orderList = [];
        foreach ($orderPages as $key => $page) {
            $orderList[$page->id] = $page->ancestors->count() ? implode(' > ', $page->ancestors->pluck('title')->toArray()) . '>' . $page->title : $page->title;
        }
        return $orderList;
    }

    public function store(StorePageRequest $request)
    {
        $requestِData = $request;
        $parent = null;
        if ($requestِData['parent_id'] > 0)
            $parent = $this->pages->findOrFail($requestِData['parent_id']);

        $page = $this->pages->create($request->only('title', 'parent_id', 'uri', 'seo_title', 'content', 'seo_description', 'order', 'state', 'template'), $parent);
        if ($requestِData['parent_id'] == 0)
            $page->saveAsRoot();
        else $page->appendToNode($parent)->save();
        return redirect(route('backend.pages.index'))->with('status', __('page.page_has_been_saved'));
    }

    public function edit($id)
    {
        $page = $this->pages->findOrFail($id);
        $templates = $this->getPageTemplates();
        $orderPages = $this->pages->all();
        $orderList = $this->paddedTitle($orderPages);
        return view(currentBackView('pages.form'), compact('page', 'templates', 'orderList'));
    }

    public function update(UpdatePageRequest $request, $id)
    {
        $page = $this->pages->findOrFail($id);
        $requestِData = $request;

        $parent = null;
        if ($requestِData['parent_id'] > 0)
            $parent = $this->pages->findOrFail($requestِData['parent_id']);

        $page->fill($request->only('title', 'parent_id', 'uri', 'seo_title', 'content', 'seo_description', 'order', 'state', 'template'), $parent)->save();
        if ($requestِData['parent_id'] == 0)
            $page->saveAsRoot();
        else $page->appendToNode($parent)->save();
        return redirect(route('backend.pages.index'))->with('status', __('page.page_has_been_saved'));
    }

    public function delete($id)
    {
        $page = $this->pages->findOrFail($id);
        $page->delete();
        return redirect(route('backend.pages.index'))->with('status', __('page.page_has_been_deleted'));
    }


    protected function getPageTemplates()
    {
        $templates = config('cms.templates');

        return ['' => ''] + array_combine(array_keys($templates), array_keys($templates));
    }
}
