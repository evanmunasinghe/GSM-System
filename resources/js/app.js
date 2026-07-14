const syncThemeToggle = (button) => {
    const isLight = document.documentElement.dataset.theme === 'light';
    const nextTheme = isLight ? 'dark' : 'light';
    const label = button.querySelector('.theme-toggle-label');

    button.setAttribute('aria-label', `Switch to ${nextTheme} mode`);
    button.setAttribute('aria-pressed', String(isLight));

    if (label) {
        label.textContent = `${nextTheme[0].toUpperCase()}${nextTheme.slice(1)} mode`;
    }
};

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        syncThemeToggle(button);

        button.addEventListener('click', () => {
            const nextTheme = document.documentElement.dataset.theme === 'light' ? 'dark' : 'light';
            document.documentElement.dataset.theme = nextTheme;

            try {
                localStorage.setItem('gms-theme', nextTheme);
            } catch (error) {
                // The selected theme remains active for the current page.
            }

            syncThemeToggle(button);
        });
    });

    const dashboardShell = document.querySelector('[data-dashboard-shell]');
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebarBackdrop = document.querySelector('[data-sidebar-backdrop]');

    const closeSidebar = () => {
        dashboardShell?.classList.remove('sidebar-is-open');
        sidebarToggle?.setAttribute('aria-expanded', 'false');
    };

    sidebarToggle?.addEventListener('click', () => {
        const isOpen = dashboardShell?.classList.toggle('sidebar-is-open') ?? false;
        sidebarToggle.setAttribute('aria-expanded', String(isOpen));
    });
    sidebarBackdrop?.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeSidebar();
    });

    document.querySelectorAll('[data-demo-credentials]').forEach((button) => {
        button.addEventListener('click', () => {
            const email = document.querySelector('#email');
            const password = document.querySelector('#password');

            if (email) email.value = button.dataset.email ?? '';
            if (password) password.value = button.dataset.password ?? '';
        });
    });

    document.querySelectorAll('[data-submit-form]').forEach((form) => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('[data-submitting-text]');

            if (button) {
                button.disabled = true;
                button.textContent = button.dataset.submittingText;
            }
        });
    });
});
