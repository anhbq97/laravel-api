$(document).ready(function() {
    let imgs = $('img');

    for (let img of imgs ) {
        if (!img.getAttribute('style')) {
            img.style.width = '100%';
            img.style.height = 'auto';
        }
    }
});