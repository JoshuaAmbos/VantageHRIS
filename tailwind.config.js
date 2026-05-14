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
            colors: {
                vantage: {
                    50: "#d9ed92", // Lightest Lime Green
                    100: "#b5e48c",
                    200: "#99d98c",
                    300: "#76c893",
                    400: "#52b69a", // Mid Mint
                    500: "#34a0a4", // Vibrant Teal
                    600: "#168aad",
                    700: "#1a759f",
                    800: "#1e6091", // Dark Blue
                    900: "#184e77", // Deepest Navy Blue
                },
                // A crisp, neutral background to let the blue/green gradient shine
                "vantage-bg": "#f8f9fa",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
