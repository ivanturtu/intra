/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'dark-blue': '#1a304f',
        'orange-brown': '#d39250',
        'beige': '#f5e6d3',
      },
    },
  },
  plugins: [],
}

