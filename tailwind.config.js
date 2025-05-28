import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                primary: '#d31310',
                secondary: '#730303',
                background: '#f7f7f2',
                accent: '#b8860b',
            }
        },
    },

    plugins: [forms],
};
