<?php

$ll_version_date = `git show -s --format="%ct" HEAD`;
$ll_version_date = date('Y-m-d', $ll_version_date);
$ll_version_hash = `git show -s --format="%h" HEAD`;

define('LL_VERSION_STATUS', 'beta');
define('LL_VERSION', $ll_version_date);
define('LL_VERSION_MINOR', $ll_version_hash);

unset($ll_version_date);
unset($ll_version_hash);
