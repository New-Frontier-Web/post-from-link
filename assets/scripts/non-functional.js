/**
 * Function that clears the output section
 * @author   Zac
 * @param    {JS Event} ev  -   Click Event
 * @return   {NA}           -   NA
 */

export function killOutput(ev) {
    $('#pfl-link').val('');
    $('#pfl-link').focus();
    $('#ret-container').hide();
    $('#publish-container').hide();
}



/**
 * Function that removes the class 'status-message-success' from the success banner so the animation is able to play again
 * @author   Zac
 * @param    {JS Event} ev  -   Animationend event
 * @return   {NA}           -   NA
 */

export function killSuccessClass() {
    $(this).removeClass('status-message-success');
}

export function focusDescriptionParent() {
    $(this).parent().css('outline', '2px solid blue');
}

export function focusOutDescriptionParent() {
    $(this).parent().css('outline', 'none');
}