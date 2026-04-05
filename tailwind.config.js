/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // Kunci untuk tombol toggle manual
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          light: '#FF8C00',  
          DEFAULT: '#F57C00', 
          dark: '#E65100',   
        },
        darkbg: '#121212', 
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'], 
      }
    },
  },
  plugins: [],
}