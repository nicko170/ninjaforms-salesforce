<?php
/**
Plugin Name: Ninja Forms - Salesforce
Plugin URI: https://github.com/nicko170/ninjaforms-salesforce
Description: Adds a custom action to Ninja Forms which adds each contact to a company in Salesforce.
Version: 0.0.1
Author: Nick Pratley
Author URI: https://github.com/nicko170

Copyright 2021 Nick Pratley.
**/

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}

require __DIR__ . '/autoload.php';

use NinjaformsSalesforce\NinjaformsSalesforce;

$nfpardot = new NinjaformsSalesforce;
$nfpardot->setInstance($nfpardot);
$nfpardot->init();


if ( ! function_exists('nfpardot')) {
    /**
     * @return NinjaformsSalesforce
     */
    function nfpardot(): NinjaformsSalesforce {
        return NinjaformsSalesforce::getInstance();
    }
}
