import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.min.js",
        "./resources/**/*.js",
        "./resources/**/*.js.map",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ['Space Grotesk"', ...defaultTheme.fontFamily.sans],
                sans: ["Hanken Grotesk", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // 'black' : "#060606"
            },
            fontSize: {
                "2xs": ".625rem",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
