/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/*.html",
    "./app/Views/**/*.html",
    "./app/Views/**/*.html",
    "./app/Views/**/**/*.html",

    "./app/Views/*.js",
    "./app/Views/**/*.js",
    "./app/Views/**/*.js",
    "./app/Views/**/**/*.js",

    "./app/Views/*.php",
    "./app/Views/**/*.php",
    "./app/Views/**/**/*.php",
    "./app/Views/**/**/**/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    ],
}

