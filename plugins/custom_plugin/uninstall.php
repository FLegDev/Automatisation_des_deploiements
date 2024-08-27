<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit; // Exit if accessed directly
}

// Supprimer les options ou les données créées par le plugin
delete_option('your_plugin_name_option');
