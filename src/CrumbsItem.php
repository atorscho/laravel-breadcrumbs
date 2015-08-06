<?php

namespace Atorscho\Crumbs;

use Atorscho\Crumbs\Exceptions\PropertyNotFoundException;
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\UrlGenerator;

class CrumbsItem
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var UrlGenerator
     */
    protected $routing;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param string       $url
     * @param string       $title
     * @param UrlGenerator $routing
     * @param Config       $config
     */
    public function __construct($url, $title, UrlGenerator $routing, Config $config)
    {
        $this->url     = $url;
        $this->title   = $title;
        $this->routing = $routing;
        $this->config  = $config;
    }

    /**
     * Return current crumb item class name when needed.
     *
     * @param bool $attr If true, it will return `class="active"`.
     *
     * @return string
     */
    public function active($attr = true)
    {
        $className = $this->config->get('crumbs.currentItemClass');

        if ($attr) {
            return $this->isActive() ? 'class="' . $className . '"' : '';
        }

        return $this->isActive() ? $className : '';
    }

    /**
     * Return true if breadcrumb item is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->url == $this->routing->current();
    }

    /**
     * Return only class' properties.
     *
     * @param string $property
     *
     * @return mixed
     * @throws PropertyNotFoundException
     */
    public function __get($property)
    {
        if (array_key_exists($property, get_class_vars(__CLASS__))) {
            return $this->{$property};
        }

        throw new PropertyNotFoundException("Property [$property] not found in class [" . __CLASS__ . '].');
    }
}
