<?php

namespace App\Http\Controllers\Backend;

use App\Faq;
use App\Http\Requests\StoreFaqRequest;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    protected $faqs;

    public function __construct(Faq $faqs)
    {
        $this->faqs = $faqs;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $faqs = $this->faqs
                ->where([['question', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $faqs = $this->faqs->paginate($limit);
        }

        return view(currentBackView('faqs.index'), compact('faqs'));
    }

    public function create(Faq $faq)
    {
        return view(currentBackView('faqs.form'), compact('faq'));
    }

    public function store(StoreFaqRequest $request)
    {
        $faq = $this->faqs->create(['slug' =>  $request->title] + $request->only('question','answer', 'state'));
        return redirect(route('backend.faqs.index'))->with('status', __('faq.faq_has_been_saved'));
    }


    public function edit($id)
    {
        $faq = $this->faqs->findOrFail($id);
        return view(currentBackView('faqs.form'), compact('faq'));
    }

    public function update(StoreFaqRequest $request, $id)
    {
        $faq = $this->faqs->findOrFail($id);
        $faq->fill(['slug' =>  $request->title] + $request->only('question','answer', 'state'))->save();
        return redirect(route('backend.faqs.index'))->with('status', __('faq.faq_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $faq = $this->faqs->findOrFail($id);
        $faq->delete();
        return redirect(route('backend.faqs.index'))->with('status', __('faq.faq_has_been_deleted'));
    }
}
