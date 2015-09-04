<?php

namespace Atorscho\Crumbs;

use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Translation\Translator;

class Crumbs
{
    /**
     * The array of breadcrumb items.
     *
     * @var array
     */
    protected $crumbs = [];

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Translator
     */
    private $translator;

    /**
     * @param Request      $request
     * @param Router       $route
     * @param UrlGenerator $url
     * @param Config       $config
     * @param Translator   $translator
     */
    public function __construct(Request $request, Router $route, UrlGenerator $url, Config $config, Translator $translator)
    {
        $this->request    = $request;
        $this->route      = $route;
        $this->url        = $url;
        $this->config     = $config;
        $this->translator = $translator;

        $this->autoAddItems();
    }

    /**
     * Add new item to the breadcrumbs array.
     *
     * @param string $url
     * @param string $title
     * @param array  $parameters
     */
    public function add($url, $title, $parameters = [])
    {
        $url = $this->parseUrl($url, $parameters);

        $this->crumbs[] = new CrumbsItem($url, $title, $this->url, $this->config);
    }

    /**
     * Add current page to the breadcrumbs array.
     *
     * @param string $title
     */
    public function addCurrent($title)
    {
        $this->add($this->url->current(), $title);
    }

    /**
     * Add home page to the breadcrumbs array.
     *
     * @return void
     */
    public function addHomePage()
    {
        $this->add($this->config->get('crumbs.homeUrl'), $this->config->get('crumbs.homeTitle'));
    }

    /**
     * Add admin page to the breadcrumbs array.
     *
     * @return void
     */
    public function addAdminPage()
    {
        $this->add($this->config->get('crumbs.adminUrl'), $this->config->get('crumbs.adminTitle'));
    }

    /**
     * Render breadcrumbs HTML.
     *
     * @param string $view Custom breadcrumbs template view.
     *
     * @return string Breadcrumbs template with all items
     */
    public function render($view = '')
    {
        // Check for existing crumbs items
        if (!$this->hasItems()) {
            return '';
        }

        // Check for custom view
        if (!$view) {
            $view = $this->config->get('crumbs.crumbsView');
        }

        return view($view, ['crumbs' => $this->getCrumbs()])->render();
    }

    /**
     * Get first item of the breadcrumbs array.
     *
     * @return mixed
     */
    public function getFirstItem()
    {
        return $this->hasCrumbs() ? $this->getCrumbs()[0] : false;
    }

    /**
     * Get last item of the breadcrumbs array.
     *
     * @return mixed
     */
    public function getLastItem()
    {
        return $this->hasCrumbs() ? end($this->getCrumbs()) : false;
    }

    /**
     * Get the breadcrumbs array.
     *
     * @return array
     */
    public function getCrumbs()
    {
        return $this->crumbs;
    }

    /**
     * Return true if breadcrumbs are not empty.
     *
     * @return bool
     */
    protected function hasCrumbs()
    {
        return (bool) $this->getCrumbs() && $this->hasManyItems();
    }

    /**
     * Return true if breadcrumbs has at least one item.
     *
     * @return bool
     */
    protected function hasItems()
    {
        return (bool) count($this->getCrumbs());
    }

    /**
     * Return true if breadcrumbs have more than one item.
     *
     * @return bool
     */
    protected function hasManyItems()
    {
        return count($this->getCrumbs()) > 1;
    }

    /**
     * Return a named route if it exists.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return string
     */
    protected function parseUrl($url, $parameters)
    {
        // If provided $url is a route name...
        if ($this->route->has($url)) {
            $url = $this->url->route($url, $parameters);
        } else {
            $url = $this->url->to($url, $parameters);
        }

        return $url;
    }

    /**
     * Automatically prefix breadcrumbs with default items.
     *
     * @return void
     */
    protected function autoAddItems()
    {
        if ($this->config->get('crumbs.displayBothPages')) {
            $this->addHomePage();

            if ($this->request->is($this->config->get('crumbs.adminPattern'))) {
                $this->addAdminPage();
            }
        } else {
            if ($this->config->get('crumbs.displayHomePage') && !$this->request->is($this->config->get('crumbs.adminPattern'))) {
                $this->addHomePage();
            }
            if ($this->config->get('crumbs.displayAdminPage') && $this->request->is($this->config->get('crumbs.adminPattern'))) {
                $this->addAdminPage();
            }
        }
    }
}
