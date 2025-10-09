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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'nyanza': { DEFAULT: '#d8f3dc', 100: '#16461d', 200: '#2b8c3a', 300: '#4cc85e', 400: '#92dd9d', 500: '#d8f3dc', 600: '#e0f5e3', 700: '#e8f8ea', 800: '#effaf1', 900: '#f7fdf8' },
                'celadon': { DEFAULT: '#b7e4c7', 100: '#173c24', 200: '#2d7847', 300: '#44b46b', 400: '#7dce99', 500: '#b7e4c7', 600: '#c7ead3', 700: '#d5efde', 800: '#e3f4e9', 900: '#f1faf4' },
                'celadon-2': { DEFAULT: '#95d5b2', 100: '#153423', 200: '#296845', 300: '#3e9b68', 400: '#61c08c', 500: '#95d5b2', 600: '#aaddc1', 700: '#c0e6d1', 800: '#d5eee0', 900: '#eaf7f0' },
                'mint': { DEFAULT: '#74c69d', 100: '#122d20', 200: '#255a3f', 300: '#37875f', 400: '#49b47e', 500: '#74c69d', 600: '#91d2b1', 700: '#acddc5', 800: '#c8e9d8', 900: '#e3f4ec' },
                'mint-2': { DEFAULT: '#52b788', 100: '#10251b', 200: '#1f4b36', 300: '#2f7052', 400: '#3f966d', 500: '#52b788', 600: '#75c5a0', 700: '#97d4b8', 800: '#bae2cf', 900: '#dcf1e7' },
                'sea_green': { DEFAULT: '#40916c', 100: '#0d1d16', 200: '#1a3a2b', 300: '#265741', 400: '#337457', 500: '#40916c', 600: '#58b68b', 700: '#82c8a8', 800: '#abdac5', 900: '#d5ede2' },
                'dartmouth_green': { DEFAULT: '#2d6a4f', 100: '#091510', 200: '#122b20', 300: '#1c4030', 400: '#255640', 500: '#2d6a4f', 600: '#439d75', 700: '#69bf98', 800: '#9bd4ba', 900: '#cdeadd' },
                'brunswick_green': { DEFAULT: '#1b4332', 100: '#050d0a', 200: '#0a1a14', 300: '#10271e', 400: '#153527', 500: '#1b4332', 600: '#327d5e', 700: '#4cb78b', 800: '#87cfb1', 900: '#c3e7d8' },
                'dark_green': { DEFAULT: '#081c15', 100: '#020604', 200: '#030b08', 300: '#05110d', 400: '#061611', 500: '#081c15', 600: '#1d664c', 700: '#32b084', 800: '#6bd5b0', 900: '#b5ead8' }
            },
        },
    },

    plugins: [forms],
};
