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
        'primary': '#1b304e',
        'secondary': '#dfdfbb',
        'tertiary': '#d3924f',
        // Legacy colors for backward compatibility
        'dark-blue': '#1b304e',
        'orange-brown': '#d3924f',
        'beige': '#dfdfbb',
      },
    },
  },
  plugins: [],
}

