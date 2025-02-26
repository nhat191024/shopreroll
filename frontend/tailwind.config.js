const primeui = require('tailwindcss-primeui');
/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'selector',
  content: [
    "./index.html",
    "./presets/**/*.{js,vue,ts}",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      textShadow: {
        'custom': 'rgb(126, 86, 63) 0px 0px 10px, rgb(40, 36, 23) 0px 0px 20px, rgb(41, 36, 24) 0px 0px 40px !important',
        'xl': '2px 2px 2px rgba(0, 0, 0, 0.5)',
      },
    },
  },
  plugins: [
    primeui,
    function({ addUtilities }) {
      const newUtilities = {
        '.text-shadow-custom': {
          textShadow: 'rgb(126, 86, 63) 0px 0px 10px, rgb(40, 36, 23) 0px 0px 20px, rgb(41, 36, 24) 0px 0px 40px !important',
        },
        'text-shadow-xl': {
          textShadow: '2px 2px 2px rgba(0, 0, 0, 0.5)',
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    }
  ],
}

