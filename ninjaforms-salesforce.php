<?php
/**
 * Plugin Name: Ninja Forms - Salesforce
 * Plugin URI: https://github.com/nicko170/ninjaforms-salesforce
 * Description: This is a really dodgy integration between Ninja Forms and Salesforce. I might get to documentation at some stage, basically, create a new form with fields that have labels of First Name, Last Name and Email, then set a custom hook action of "ninja_forms_salesforce_action"
 * Version: 0.0.1
 * Author: Nick Pratley
 * Author URI: https://github.com/nicko170.
 *
 * Copyright 2021 Nick Pratley.
 **/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    exit;
}

require __DIR__.'/autoload.php';

use NinjaformsSalesforce\NinjaformsSalesforce;

$nfpardot = new NinjaformsSalesforce();
$nfpardot->setInstance($nfpardot);
$nfpardot->init();

if (!function_exists('nfpardot')) {
    /**
     * @return NinjaformsSalesforce
     */
    function nfpardot(): NinjaformsSalesforce
    {
        return NinjaformsSalesforce::getInstance();
    }
}
