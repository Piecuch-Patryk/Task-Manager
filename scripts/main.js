// set background color when message displayed;
function errorFieldBgc(){
    const $el = $('.error-form');
    for(let i = 0; i < $el.length; i++){
        if($($el[i]).text() != ''){
            $($el[i]).css('background-color', 'rgba(255, 255, 255, .1)');
        }else {
            $($el[i]).css('background', 'none');
        }
    }
}
$(document).ready(errorFieldBgc);