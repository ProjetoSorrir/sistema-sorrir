import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                nunito: ["Nunito", "sans-serif"],
            },
            backgroundImage: {
                "wins-texture": "url('/imgs/bg-vencedores.png')",
            },
            colors: {
                primary: "#FFFFFF",
                "primary-50": "rgba(94, 11, 130, 0.50)",
                secondary: "#FFFFFF",
                "secondary-50": "rgba(255, 225, 93, 0.50)",
                black: "#09010C",
                "black-50": "rgba(9,1,12, 0.50)",
                "light-grey": "#E3E1E4",
                "medium-grey": "#CCCCCC",
                "dark-grey": "#585659",
                "light-purple": "#FBF4FE",
                "light-yellow": "#FFDB43",
                "light-green": "#DBF0E5",
                "custom-green": "#08651D",
                "dark-green": "#1C391D",
                "custom-red": "#E00E0E",
                "dark-red": "#961465",
                "red-20": "rgba(224, 14, 14, 0.20)",
                "light-pink": "#FFD6D6",
                "we-bg": "#736E70",
                "we-highlight": "#83c44c",
            },
        },
    },

    plugins: [forms],
};
