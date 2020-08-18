/*
* ============================================================================
* ============================= Errors Script JS =============================
* ============================================================================
*/

getErrorType();

function getErrorType() {

    type = document.querySelector('body').dataset.type;
    message = '';
    explain = '';

    switch (type) {

        case '200':
            message = 'All\'s good.';
            explain = 'Everything\'s rollin\' right so what are you doin\' here...?';
            break;

        case '403':
            message = 'Forbiden access.';
            explain = 'You don\'t permission to access this folder/file.';
            break;

        case '404':
            message = 'Page not found.';
            explain = 'Are you sure about your request ?';
            break;

        case '500':
            message = 'Internal Server error.';
            explain = 'Seems like your server met script parsing troubles...';
            break;
    }

    console.clear('test');
    console.log('🚫 %c' + type + ' Error -> ' + message + ' %c' + explain, 'color:#ff531a; font-weight:bold;', 'color:inherit');
}