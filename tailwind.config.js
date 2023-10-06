/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/**/*.css",

  ],
  theme: {

    colors: {
      'main' : '#ffffff',
      'text2': '#040316',
      'background2': '#f5f5f5',
      'primary2': '#f5f5db',
      'secondary2': '#5a362a',
      'accent2': '#f75c02',
     },
     

    container: {
      center: true,
      padding: '20px',
    },
    extend: {
      fontSize: {
        sm: '0.750rem',
        base: '1rem',
        xl: '1.333rem',
        '2xl': '1.777rem',
        '3xl': '2.369rem',
        '4xl': '3.158rem',
        '5xl': '4.210rem',
      },

      fontFamily: {
        heading: 'Inter',
        body: 'Inter',
      },

      fontWeight: {
        normal: '400',
        bold: '700',
      },
    },
  },
  

  plugins: [['prettier-plugin-tailwindcss'], require('@tailwindcss/typography'), require ("daisyui"), require('@tailwindcss/forms'),],

    daisyui: {
    themes: [
      
    ],
    },
}

