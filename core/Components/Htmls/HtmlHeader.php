<?php

namespace Synext\Components\Htmls;

class HtmlHeader
{
    private $url;
    private $logo;
    private $creator;
    private $description;
    private $title;
    private $keywords;

    public function __construct(string $description = null, string $title = null, string $keywords = null)
    {
        $this->url = '';
        $this->logo = '';
        $this->creator = '';
        $this->description = $description;
        $this->title = $title;
        $this->keywords = $keywords;
    }

    public function showHtmlHeader(): string
    {
        return $this->htmlTitle()."\n".$this->htmlHeader()."\n".$this->facebookHeader()."\n".$this->twiterHeader();
    }

    private function htmlTitle()
    {
        return '<title>'.$this->title.'</title>';
    }

    private function twiterHeader()
    {
        return '<meta name="twitter:card" content="sommaire">
        <meta name="twitter:url" content="'.$this->url.'">
        <meta name="twitter:creator" content="@'.$this->creator.'" />
        <meta name="twitter:title" content="'.$this->title.'">
        <meta name="twitter:description" content="'.$this->description.'">
        <meta name="twitter:image" content="'.$this->logo.'">';
    }

    private function facebookHeader()
    {
        return '<meta property="og:title" content="'.$this->title.'">
        <meta property="og:type" content="website" />
        <meta property="og:title" content="'.$this->title.'" />
        <meta property="og:description" content="'.$this->description.'">
        <meta property="og:image" content="'.$this->logo.'" />
        <meta property="og:image:type" content="image/jpg" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="'.$this->url.'" />
        <meta property="og:site_name" content="" />
        <meta property="fb:page_id" content="" />';
    }

    private function htmlHeader()
    {
        return '<meta name="author" content="'.$this->creator.'">
        <meta property="og:title" content="'.$this->title.'" />
        <meta property="og:description" content="'.$this->description.'" />
        <meta property="og:image" content="'.$this->logo.'" />
        <meta name="keywords" content="'.$this->keywords.' ">
        <meta property="og:url" content="'.$this->url.'" />';
    }
}
