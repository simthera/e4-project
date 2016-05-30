<?php
    /*
     * Some Minor WP Security Enhancements
     */
    function removeVersionNumber() {
        return '';
    }
    add_filter('the_generator', 'removeVersionNumber');