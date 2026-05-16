import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

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
                vantage: {
                    DEFAULT: "#06b6d4",
                    50: "#ecfeff",
                    100: "#cffafe",
                    200: "#a5f3fc",
                    300: "#67e8f9",
                    400: "#22d3ee",
                    500: "#06b6d4", // Primary Accent
                    600: "#0891b2",
                    700: "#0e7490",
                    800: "#155e75",
                    900: "#0f172a", // Sidebar Slate
                    950: "#020617", // Sidebar Header Dark Slate
                    bg: "#f8fafc", // Canvas background
                },
            },
        },
    },

    plugins: [forms],
};
