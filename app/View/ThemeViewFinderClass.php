<?php

namespace Cms\View;

use Illuminate\View\FileViewFinder;

class ThemeViewFinder extends FileViewFinder
{
    protected $frontActiveTheme;
    protected $backActiveTheme;
    protected $basePath;

    /**
     * @return mixed
     */
    public function getActiveTheme()
    {
        return $this->activeTheme;
    }

    /**
     * @param mixed $activeTheme
     */
    public function setActiveTheme($frontActiveTheme,$frontMobileActiveTheme,$backActiveTheme): void
    {
        $this->frontActiveTheme = $frontActiveTheme;
        $this->backActiveTheme = $backActiveTheme;
        array_unshift($this->paths,
            $this->basePath.'/backend/'.$backActiveTheme.'/views',
            $this->basePath.'/frontend/'.$frontMobileActiveTheme.'/views',
            $this->basePath.'/frontend/'.$frontActiveTheme.'/views');
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param mixed $basePath
     */
    public function setBasePath($basePath): void
    {
        $this->basePath = $basePath;
    }

}
