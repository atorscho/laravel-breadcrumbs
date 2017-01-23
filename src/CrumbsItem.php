<?php

namespace Atorscho\Crumbs;

use Atorscho\Crumbs\Exceptions\PropertyNotFoundException;
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\UrlGenerator;

/**
 * Atorscho\Crumbs\CrumbsItem
 *
 * @property string $title    Item title.
 * @property string $url      Item URL.
 *
 * @package Atorscho\Crumbs
 * @version 2.2.2
 */
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
     * @param bool   $attr      If true, it will return `class="active"`.
     * @param string $className Active item class. Default: 'active'
     *
     * @return string
     */
    public function active($attr = true, $className = '')
    {
        if (!$className) {
            $className = $this->config->get('crumbs.current_item_class');
        }

        if ($attr) {
            return $this->isActive() ? 'class="' . $className . '"' : '';
        }

        return $this->isActive() ? $className : '';
    }

    /**
     * Return disabled class name when needed.
     *
     * @param string $className
     *
     * @return mixed|string
     */
    public function disabled($className = '')
    {
        if (!$className) {
            $className = $this->config->get('crumbs.disabled_item_class');
        }

        return $this->isDisabled() ? $className : '';
    }

    /**
     * Return true if current breadcrumb item is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->url == $this->routing->current();
    }

    /**
     * Return true if current breadcrumb item is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return $this->url == '#';
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
