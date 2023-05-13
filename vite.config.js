import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import toast from "toastr/toastr/css";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/css/main.css",
                "resources/js/main.js",
                "resources/css/util.css",
                "resources/js/workingArea.js",
                "resources/js/calendar.js",
                toast,
            ],
            refresh: true,
        }),
    ],
});
