<?php
/*
Plugin Name: Basic_custom_plugin
Description: Base to start a new custom plugin.
Version: 1.0
Author: FLegDev.fr
Author URI: https://flegdev.fr
License: GPL2
Text Domain: basic-custom-plugin
*/

// Sécurité : Empêche l'accès direct à ce fichier
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Définir des constantes pour le chemin du plugin
define('YOUR_PLUGIN_NAME_PATH', plugin_dir_path(__FILE__));

// Inclure les fichiers nécessaires
require_once YOUR_PLUGIN_NAME_PATH . 'includes/class-your-plugin-name.php';

// Exécuter le plugin
function your_plugin_name_init() {
    $plugin = new Your_Plugin_Name();
    $plugin->run();
}
add_action('plugins_loaded', 'your_plugin_name_init');
