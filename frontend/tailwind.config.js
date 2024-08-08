const primeui = require('tailwindcss-primeui');
/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'selector',
  content: [
    "./index.html",
    "./presets/**/*.{js,vue,ts}",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  plugins: [primeui]
}

