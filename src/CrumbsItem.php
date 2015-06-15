<?php namespace Atorscho\Crumbs;

use Atorscho\Crumbs\Exceptions\PropertyNotFoundException;
use Illuminate\Routing\UrlGenerator;
use URL;

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
     * @param string       $url
     * @param string       $title
     * @param UrlGenerator $routing
     */
    public function __construct( $url, $title, UrlGenerator $routing )
    {
        $this->url     = $url;
        $this->title   = $title;
        $this->routing = $routing;
    }

    /**
     * Return current crumb item class name when needed.
     *
     * @param bool $attr If true, it will return `class="active"`.
     *
     * @return string
     */
    public function active( $attr = true )
    {
        if ($attr) {
            return $this->isActive() ? 'class="' . config('crumbs.currentItemClass') . '"' : '';
        }


        return $this->isActive() ? config('crumbs.currentItemClass') : '';
    }

    /**
     * Return true if breadcrumb item is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->url == URL::current();
    }

    /**
     * Return only class' properties.
     *
     * @param string $property
     *
     * @return mixed
     * @throws PropertyNotFoundException
     */
    public function __get( $property )
    {
        if (array_key_exists($property, get_class_vars(__CLASS__))) {
            return $this->{$property};
        }

        throw new PropertyNotFoundException("Property [$property] not found in class [" . __CLASS__ . '].');
    }

}
