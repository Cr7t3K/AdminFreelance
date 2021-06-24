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
import 'datatables.net-bs4'
import 'jquery.easing'
import 'bootstrap-datepicker'
import 'bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min'

// Import Jquery & Popover Bootstrap
const $ = require('jquery');
require('bootstrap');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
    $('#dataTable').DataTable();
    $('.toast').toast('show');
    $('.js-datepicker').datepicker({
        language: 'fr',
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
});

// start the Stimulus application
import './bootstrap';


