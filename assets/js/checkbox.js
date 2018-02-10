$(document).ready(function(){
    $('input.checkbox').on('change', function() {
        $('input.checkbox').not(this).prop('checked', false);  
    });
});