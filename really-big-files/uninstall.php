<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Really_Big_Files
 * @author    Brian Cash <bcash@alpineinternet.com>
 * @license   GPL-2.0+
 * @link      http://alpineinternet.com
 * @copyright 2013 Alpine Internet Solutions, Inc.
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// TODO: Define uninstall functionality here