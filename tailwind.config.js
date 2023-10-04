/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/**/*.css",

  ],
  theme: {
    container: {
      center: true,
      padding: '16px',
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
  

  plugins: [require('@tailwindcss/typography'), require ("daisyui"), require('@tailwindcss/forms'),],
    daisyui: {
    themes: [],
  },
}

