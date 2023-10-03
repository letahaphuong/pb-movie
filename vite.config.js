import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        react(),
    ],
    env: {
        VITE_URL_API: process.env.URL_API, // Use VITE_ prefix
    },
});
