/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            serif: ["Noto Serif", "serif"],
            inter: ["Inter", "sans-serif"],
            "inria-serif": ["Inria Serif", "sans-serif"],
        },
        container: {
            center: true,
            padding: "16px",
        },
        extend: {
            colors: {
                secondary: "#64748B",
            },
            screens: {
                "2xl": "1280px",
            },
        },
    },
    plugins: [],
};
