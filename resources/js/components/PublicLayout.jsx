import AppFooter from './AppFooter';
import ThemeToggle from './ThemeToggle';

export default function PublicLayout({ children }) {
    return (
        <>
            <ThemeToggle />
            {children}
            <AppFooter />
        </>
    );
}
