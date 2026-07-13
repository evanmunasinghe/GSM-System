<script>
    (() => {
        try {
            const savedTheme = localStorage.getItem('gms-theme');
            document.documentElement.dataset.theme = savedTheme === 'light' ? 'light' : 'dark';
        } catch (error) {
            document.documentElement.dataset.theme = 'dark';
        }
    })();
</script>

