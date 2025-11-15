import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

// Importa o wayfinder dinamicamente pq ñ é boa prática ter ele em produção :V
const getWayfinder = async () => {
    let wayfinder: any = null;

    if (!process.env.SKIP_WAYFINDER) {
        wayfinder = (await import('@laravel/vite-plugin-wayfinder')).wayfinder({
            formVariants: true,
        });
    }

    return wayfinder;
};

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react(),
        tailwindcss(),
        await getWayfinder(),
    ],
    esbuild: {
        jsx: 'automatic',
    },
});
