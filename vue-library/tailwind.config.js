/** @type {import('tailwindcss').Config} */
export default {
 content: ['./public/**/*.html', './src/**/*.{vue,js,ts,jsx,tsx}', "./node_modules/flowbite/**/*.js"],
  // darkMode:true,
  theme: {
    extend: {},
  },
    plugins: [
        require('flowbite/plugin')
    ] 
}

