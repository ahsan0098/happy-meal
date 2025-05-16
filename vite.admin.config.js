import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/admin/app.css", "resources/js/admin/app.js"],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true,
        outDir: "public/assets/admin",
    },
    base: "/assets/admin/"
});
