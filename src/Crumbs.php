<?php

namespace Atorscho\Crumbs;

use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Translation\Translator;

/**
 * Atorscho\Crumbs\Crumbs
 *
 * @package Atorscho\Crumbs
 * @version 2.1.6
 */
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
    protected $route;

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
    protected $config;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param Request      $request
     * @param Router       $route
     * @param UrlGenerator $url
     * @param Config       $config
     * @param Translator   $translator
     */
    public function __construct(
        Request $request,
        Router $route,
        UrlGenerator $url,
        Config $config,
        Translator $translator
    ) {
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
     *
     * @return $this
     */
    public function add($url, $title = '', $parameters = [])
    {
        // If only {$url} specified, use it as title for current page
        if (func_num_args() === 1) {
            return $this->addCurrent($url);
        }

        $url = $this->parseUrl($url, $parameters);

        $this->crumbs[] = new CrumbsItem($url, $title, $this->url, $this->config);

        return $this;
    }

    /**
     * Add current page to the breadcrumbs array.
     *
     * @param string $title
     *
     * @return $this
     */
    public function addCurrent($title)
    {
        return $this->add($this->url->current(), $title);
    }

    /**
     * Add home page to the breadcrumbs array.
     *
     * @return $this
     */
    public function addHomePage()
    {
        return $this->add($this->config->get('crumbs.home_url'), $this->config->get('crumbs.home_title'));
    }

    /**
     * Add admin page to the breadcrumbs array.
     *
     * @return $this
     */
    public function addAdminPage()
    {
        return $this->add($this->config->get('crumbs.admin_url'), $this->config->get('crumbs.admin_title'));
    }

    /**
     * Return structured page title string.
     *
     * @return string
     *
     * @since 2.1.7
     */
    public function pageTitle()
    {
        // Get crumbs titles
        $crumbs = array_map(function ($crumb) {
            return $crumb->title;
        }, $this->crumbs);

        // Reverse array elements order
        $crumbs = array_reverse($crumbs);

        return implode($this->config->get('crumbs.page_title_separator'), $crumbs);
    }

    /**
     * Render breadcrumbs HTML.
     *
     * @param string $view Custom breadcrumbs template view.
     *
     * @return string Breadcrumbs template with all items.
     */
    public function render($view = '')
    {
        // Check for existing crumbs items
        if (!$this->hasItems()) {
            return '';
        }

        // Check for custom view
        if (!$view) {
            $view = $this->config->get('crumbs.crumbs_view');
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
        if ($this->config->get('crumbs.display_both_pages')) {
            $this->addHomePage();

            if ($this->request->is($this->config->get('crumbs.admin_Pattern'))) {
                $this->addAdminPage();
            }
        } else {
            if ($this->config->get('crumbs.display_home_page') && !$this->request->is($this->config->get('crumbs.admin_Pattern'))) {
                $this->addHomePage();
            }
            if ($this->config->get('crumbs.display_admin_page') && $this->request->is($this->config->get('crumbs.admin_Pattern'))) {
                $this->addAdminPage();
            }
        }
    }

    /**
     * Return an instance of Crumbs.
     *
     * @return $this
     *
     * @since 2.1.7
     */
    public function getInstance()
    {
        return $this;
    }
}
