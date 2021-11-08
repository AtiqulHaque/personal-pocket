<?php

namespace App\Services\Crawler;

use App\Contracts\ContentRepository;
use App\Contracts\Service\ResponseProcessor;
use App\Contracts\SiteContentRepository;
use DOMXPath;

class HtmlResponse
{
    public $title = null;
    public $excerpt = null;
    public $img = null;

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @param null $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * @return null
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param null $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }
}
