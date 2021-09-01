import { displayResults, publishResults, handleMediaLibrary } from './functional.js';
import {focusDescriptionParent, focusOutDescriptionParent, killOutput, killSuccessClass} from './non-functional.js';

jQuery(document).ready(function( $ ) {



    /** | Tracking Events | **/

    $('#ret-image i')
        .on('click', handleMediaLibrary);

    $('#pfl-submit')
        .on('click', displayResults);

    $('.pfl-publish')
        .on('click', publishResults);

    $('.pfl-clear')
        .on('click', killOutput);

    $('.success-message')
        .on('animationend', killSuccessClass)

    /** End Tracking Events **/



    /** | Page Load Functions | **/

    $('#pfl-link').focus(); // Focuses on the input box on page load

    $('#ret-description').focus( focusDescriptionParent );
    $('#ret-description').focusout( focusOutDescriptionParent );


    /** End Page Load Functions **/



})