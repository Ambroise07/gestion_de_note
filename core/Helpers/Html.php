<?php
namespace Synext\Helpers;
class Html{

    public static function navbaractive_(string $name, string $url, string $icon = null): string
    {
        $class = 'nav-link ';
        if ($_SERVER['REQUEST_URI'] === $url) {
            $class .= 'active';
        }

        return <<<HTML
            <li class="nav-item">
                <a class="$class" href="$url">  $name <i class="fa fa-$icon"> </i></a>
            </li>
HTML;
    }
    public static function assidebaractive(string $name,string $count, string $url, string $icon = null): string
    {
        $class = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center ';
        if ($_SERVER['REQUEST_URI'] === $url) {
            $class .= 'active';
        }

        return <<<HTML
            <a class="$class" href="$url">$name  <span class="badge badge-info badge-pill">$count</span> </a>            
HTML;
    }
    public static function navbaractive(string $name, string $url, string $icon = null): string
    {
        $class = 'nav-link ';
        if ($_SERVER['REQUEST_URI'] === $url) {
            $class .= 'active';
        }

        return <<<HTML
            <li class="nav-item">
                <a class="$class" href="$url"> <span data-feather="$icon"></span> $name </a>
            </li>
HTML;
    }
}

