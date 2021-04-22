<?php

namespace Synext\Routers;

use AltoRouter;
use Exception;

class Router{
    /**
     * router.
     *
     * @var AltoRouter
     */
    private $router;
    /**
     * view_path.
     *
     * @var string
     */
    private $view_path;
    private $layout_path;
    private $default_layout_path;
    private $admin_layout_Path ;
    private $ajaxs_path;

    public function __construct(string $view_path, string $public_path)
    {
        $this->view_path = $view_path;
        $this->layout_path = $public_path.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR;
        $this->ajaxs_path = $public_path.DIRECTORY_SEPARATOR;
        $this->router = new AltoRouter();
    }

    /**
     * genrate url by link name.
     *
     * @param string $name
     * @param array  $param
     *
     * @return string
     */
    public function url(string $name, array $param = []): string
    {
        return $this->router->generate($name, $param);
    }

    /**
     * get method for router.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    /**
     * post routing.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }
    /**
     * getpost routing.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function getPost(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET|POST', $url, $view, $name);

        return $this;
    }
    public function resource(array $params){
        $this->router->addRoutes($params);
        return $this;
    }
    public function run(): self
    {
        $match = $this->router->match();
        #dd($match);
        if(is_bool($match)){
            header('HTTP/1.0 404 Not Found', true, 404);
            require_once $this->view_path.DIRECTORY_SEPARATOR.'404.php';
            die();
        }
        $ajax_request = explode('/',$match['target']);
        
        if(is_bool($match)){
            header('HTTP/1.0 404 Not Found', true, 404);
            require_once $this->view_path.DIRECTORY_SEPARATOR.'404.php';
            die();
        }
        $view = $match['target'];
        $params = $match['params'];
        /** @var Router */
        $router = $this;
        $content_files = $this->view_path.DIRECTORY_SEPARATOR.$view.'.php';
        #dd($content_files);
        if(!file_exists($content_files)){
                       header('HTTP/1.0 404 Not Found', true, 404);
            require_once $this->view_path.DIRECTORY_SEPARATOR.'404.php';
            die();
        }

        if(in_array('admins',$ajax_request)){
            ob_start();
            require_once $content_files;
            $contents = ob_get_clean();
            /** default layout path */
            $this->default_layout_path = $this->ajaxs_path.'admins'.DIRECTORY_SEPARATOR.'index.php';
            require_once dirname(__DIR__,2).$this->default_layout_path;
            return $this;
            exit;
        }
        if(in_array('ajaxs',$ajax_request)){
            ob_start();
            require_once $content_files;
            $contents = ob_get_clean();
            /** default layout path */
           # $this->default_layout_path = $this->ajaxs_path.'ajaxs'.DIRECTORY_SEPARATOR.'index.php';
            require_once dirname(__DIR__,2).$this->ajaxs_path.'ajaxs'.DIRECTORY_SEPARATOR.'index.php';
            return $this;
            exit;
        } else{        
            ob_start();
            require_once $content_files;
            $contents = ob_get_clean();
            /** default layout path */
            $this->default_layout_path = $this->layout_path.'index.php';
            require_once dirname(__DIR__,2).$this->default_layout_path;
            return $this;
    }

    }
}