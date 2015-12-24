<?php

if (!function_exists('crumbs')) {
    /**
     * Add an item to the breadcrumbs.
     * If no parameters specified, return an instance of Crumbs.
     *
     * @param string $url
     * @param string $title
     * @param array  $parameters
     *
     * @return Crumbs
     */
    function crumbs($url = '', $title = '', $parameters = [])
    {
        if (func_num_args() === 0) {
            return app('crumbs');
        } elseif (func_num_args() === 1) {
            return Crumbs::addCurrent($url);
        }

        return Crumbs::add($url, $title, $parameters);
    }
}
