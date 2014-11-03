<?php

if ( !function_exists('toObjects') )
{
	/**
	 * Recursively convert all nested arrays to objects.
	 *
	 * @param $array
	 *
	 * @return stdClass
	 */
	function toObjects( $array )
	{
		$object = new stdClass();
		foreach ( $array as $key => $value )
		{
			$object->$key = $value;
			if ( is_array($value) )
				$object->$key = toObjects($value);
		}

		return $object;
	}
}

if ( !function_exists('crumbs') )
{
	/**
	 * Function renders crumbs.
	 */
	function crumbs()
	{
		Crumbs::render();
	}
}
