const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            white : {
                DEFAULT : '#FFF'
            },
            black : {
                DEFAULT : '#333'
            },
            blue: {
              light: '#E5F5FE',
              DEFAULT: '#009EFC',
              dark: '#009EFC',
            },
            red: {
              DEFAULT: '#E50915',
            },
            green: {
              DEFAULT: '#33CC00',
            },
            gray: {
                light: '#F5F5F5',
                DEFAULT: '#999999',
                dark: '#999999',
            }
          },

          borderColor: theme => ({
            ...theme('colors'),
             DEFAULT: '#EAEAEA'
           }),

            extend: {
                fontFamily: {
                    sans: ['Rubik', ...defaultTheme.fontFamily.sans],
                },
            },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
