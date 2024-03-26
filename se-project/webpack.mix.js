const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/jquery.min.js", "public/js") // เพิ่มการคอมไพล์ JS สำหรับไฟล์ jQuery
    .postCss("resources/css/app.css", "public/css", []); // เพิ่มการคอมไพล์ CSS
