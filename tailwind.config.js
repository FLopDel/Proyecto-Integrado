const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            backgroundImage: {
                'gallery09': 'url("http://lafuenterestaurante.es/resources/img/gallery09.jpg")',
                'gallery08': 'url("http://lafuenterestaurante.es/resources/img/gallery08.jpg")',
                'gallery07': 'url("http://lafuenterestaurante.es/resources/img/gallery07.jpg")',
                'gallery02': 'url("http://lafuenterestaurante.es/resources/img/gallery02.jpg")',
                'gallery01': 'url("http://lafuenterestaurante.es/resources/img/gallery01.jpg")',
                'reserv1': 'url("http://lafuenterestaurante.es/resources/img/reserv1.jpg")',
                'reserv2': 'url("http://lafuenterestaurante.es/resources/img/reserv2.jpg")',
                'reserv3': 'url("http://lafuenterestaurante.es/resources/img/reserv3.jpg")',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                cabin: ['Cabin Condensed', 'sans-serif'],
                yellowtail: ['Yellowtail', 'cursive'],
                oswald: ['Oswald', 'sans-serif'],
                dancingscript: ['Dancing Script', 'cursive'],
                lobster: ['Lobster', 'cursive'],
                open: ['Open Sans', 'sans-serif'],
                great: ['Great Vibes', 'cursive']
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
