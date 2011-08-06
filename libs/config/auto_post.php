<?php

/*
 * Set DEBUG constants
 */
define('LL_DEBUG_JS', LL_DEBUG === TRUE || (is_array(LL_DEBUG) ? in_array('js', LL_DEBUG) : in_array('js', explode(',', LL_DEBUG))));
define('LL_DEBUG_CSS', LL_DEBUG === TRUE || (is_array(LL_DEBUG) ? in_array('css', LL_DEBUG) : in_array('css', explode(',', LL_DEBUG))));
define('LL_DEBUG_SQL', LL_DEBUG === TRUE || (is_array(LL_DEBUG) ? in_array('sql', LL_DEBUG) : in_array('sql', explode(',', LL_DEBUG))));
define('LL_DEBUG_PHP', LL_DEBUG === TRUE || (is_array(LL_DEBUG) ? in_array('php', LL_DEBUG) : in_array('php', explode(',', LL_DEBUG))));
define('LL_DEBUG_SMARTY', LL_DEBUG === TRUE || (is_array(LL_DEBUG) ? in_array('smarty', LL_DEBUG) : in_array('smarty', explode(',', LL_DEBUG))));