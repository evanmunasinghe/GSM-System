(() => {
    const root = document.documentElement;
    const toggle = document.querySelector('.theme-toggle');

    if (!toggle) {
        return;
    }

    const label = toggle.querySelector('.theme-toggle-label');

    const updateToggle = () => {
        const isLight = root.dataset.theme === 'light';
        const nextTheme = isLight ? 'dark' : 'light';

        label.textContent = `${nextTheme[0].toUpperCase()}${nextTheme.slice(1)} mode`;
        toggle.setAttribute('aria-label', `Switch to ${nextTheme} mode`);
        toggle.setAttribute('aria-pressed', String(isLight));
    };

    toggle.addEventListener('click', () => {
        root.dataset.theme = root.dataset.theme === 'light' ? 'dark' : 'light';

        try {
            localStorage.setItem('gms-theme', root.dataset.theme);
        } catch (error) {
            // The theme still works for this page when storage is unavailable.
        }

        updateToggle();
    });

    updateToggle();
})();

