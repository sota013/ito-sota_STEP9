document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('search-form');
    const results = document.getElementById('products-table-wrapper');

    if (!form || !results) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const params = new URLSearchParams(new FormData(form));
        const url = `${form.action}?${params.toString()}`;

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('検索に失敗しました。');
            }

            const data = await response.json();

            results.innerHTML = data.html;

            window.history.replaceState({}, '', url);

        } catch (error) {
            alert('検索に失敗しました。ページを再読み込みしてお試しください。');
        }
    });
});