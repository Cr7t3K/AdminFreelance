/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import './styles/app.scss';

// For AdminTheme
import './js/sb-admin-2';
import 'chart.js'
import 'jquery.easing'

// Import Jquery & Popover Bootstrap
const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();

    $('.toast').toast('show')
});

// start the Stimulus application
import './bootstrap';


