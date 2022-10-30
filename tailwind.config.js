/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        //   "./public/index.php",
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
        fontFamily: {
            sans: ["Roboto", "Arial"],
        },
        extend: {
            colors: {
                modal: "rgba(0, 0, 0, 0.5)",
                mainblue: "#5BB9FD",
                lightblue: "#70C3FE",
                darkblue: "#3490dc",
                darkmodecolor: {
                    100: "#757474",
                    200: "#302C2D",
                    300: "#1E1E1E",
                    400: "#252525",
                    500: "#2E2E2E",
                    600: "#141414",
                    700: "#0A0A0A",
                },
            },
        },
    },
    plugins: [],
};
