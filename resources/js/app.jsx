import { createInertiaApp, router } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (typeof document.startViewTransition !== 'function') {
    let navigationDelay;

    router.on('start', () => {
        if (reducedMotion.matches) {
            return;
        }

        window.clearTimeout(navigationDelay);
        navigationDelay = window.setTimeout(() => {
            document.documentElement.classList.add('is-navigating');
        }, 80);
    });

    router.on('finish', () => {
        window.clearTimeout(navigationDelay);
        window.requestAnimationFrame(() => {
            document.documentElement.classList.remove('is-navigating');
        });
    });
}

createInertiaApp({
    defaults: {
        visitOptions: () => ({
            viewTransition: !reducedMotion.matches,
        }),
    },

    progress: {
        delay: 120,
        color: '#f97316',
        includeCSS: true,
        showSpinner: false,
    },

    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.jsx`,
            import.meta.glob('./pages/**/*.jsx'),
        ),

    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
