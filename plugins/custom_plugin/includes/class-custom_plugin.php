<?php

class Your_Plugin_Name {

    public function __construct() {
        // Code d'initialisation du plugin
        $this->define_hooks();
    }

    private function define_hooks() {
        add_action('init', array($this, 'your_custom_function'));
    }

    public function your_custom_function() {
        // Votre logique personnalisée
    }

    public function run() {
        // Code qui s'exécute lors de l'initialisation du plugin
    }
}
