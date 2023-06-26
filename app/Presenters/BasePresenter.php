<?php


namespace App\Presenters;


use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class BasePresenter extends Presenter
{
    protected $markDown;

    public function __construct($entity)
    {
        $this->markDown = new CommonMarkConverter();
        parent::__construct($entity);
    }

    protected function filter_editor($content)
    {
        $content = str_replace("&lt;", "<", $content);
        $content = str_replace("&gt;", ">", $content);
        $content = str_replace("&amp;", "&", $content);
        $content = str_replace("&nbsp;", " ", $content);
        $content = str_replace("&quot;", "\"", $content);
        //$content = str_replace("\\n", "<br>", $content);
       // $content = str_replace("\n", "<br>", $content);
        $content = str_replace("\\", "", $content);
        /* $content = $this->convert_tag_to_link($content);
         $content = $this->convert_username_to_link($content);
         $content = $this->gifbb2html($content);*/
        return $content;
    }

    public function descriptionHtml()
    {
        return $this->description ? $this->filter_editor($this->description) : null;
    }

    public function extra_dataHtml()
    {
        return $this->extra_data ? $this->markDown->convertToHtml($this->extra_data) : null;
    }
}
