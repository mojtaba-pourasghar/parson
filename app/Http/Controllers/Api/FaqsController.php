<?php

namespace App\Http\Controllers\Api;


use App\Faq;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;


class FaqsController extends Controller
{
    protected $faqs;


    public function __construct(Faq $faqs)
    {
        $this->faqs = $faqs;
        parent::__construct();
    }

    public function list()
    {
        $faqs = $this->faqs
            ->select('id', 'question', 'answer')
            ->where([['state', 1]])
            ->get();
        return response()->json(['faqs' => $faqs, 'success' => 1]);
    }

    public function view($id)
    {
        $faq = $this->faqs
            ->select('id', 'question', 'answer')
            ->where([['state', 1], ['id', $id]])
            ->first();

        return response()->json(['faq' => $faq, 'success' => 1]);
    }


}
