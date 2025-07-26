import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                softgreen: {
                    50: '#f3fcf7',
                    100: '#e0f7ea',
                    200: '#b6eed2',
                    300: '#FFFFFF',
                    400: '#FFFFFF',
                    500: '#C4C2AF', // principal, más suave
                    600: '#219a59',
                    700: '#808080', // bode de las cards
                    800: '#175f39',
                    900: '#C4C2AF', // iconos del footer y linea que separa la imagen e info de las cards
                },
                primary: {
                    DEFAULT: '#041F04',
                },
            },
            boxShadow: {
                'card-hover': '0 0 16px 2px rgba(194,184,149,0.5)',
            },
        },
    },

    plugins: [forms],
};
