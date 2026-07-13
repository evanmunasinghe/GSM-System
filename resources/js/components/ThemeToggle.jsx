import { useState } from 'react';

export default function ThemeToggle() {
    const [theme, setTheme] = useState(
        () => document.documentElement.dataset.theme || 'dark',
    );

    const toggleTheme = () => {
        const nextTheme = theme === 'light' ? 'dark' : 'light';

        document.documentElement.dataset.theme = nextTheme;
        setTheme(nextTheme);

        try {
            localStorage.setItem('gms-theme', nextTheme);
        } catch (error) {
            // The theme remains active for this page when storage is unavailable.
        }
    };

    const nextTheme = theme === 'light' ? 'dark' : 'light';

    return (
        <button
            className="theme-toggle"
            type="button"
            aria-label={`Switch to ${nextTheme} mode`}
            aria-pressed={theme === 'light'}
            onClick={toggleTheme}
        >
            <svg className="theme-icon theme-icon-sun" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.66 6.34l1.41-1.41" />
            </svg>
            <svg className="theme-icon theme-icon-moon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
            </svg>
            <span className="theme-toggle-label">
                {nextTheme[0].toUpperCase() + nextTheme.slice(1)} mode
            </span>
        </button>
    );
}
