/*******    JS BACK-OFFICE    ********/
$(document).ready(function() {
    
    tinymce.init({
        selector: '.tinyblog',
        height: 300,
        theme: 'modern',
        plugins: ['lists advlist image imagetools insertdatetime'],
        content_css: 'https://tinymce.com/css/codepen.min.css'
    });
});