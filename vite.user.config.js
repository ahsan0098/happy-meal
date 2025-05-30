import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/visitor/app.css",
                "resources/js/visitor/app.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true,
        outDir: "public/assets/user",
    },
    base: "/assets/user/",
});
