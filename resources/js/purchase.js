document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('purchase-form');
    const dialog = document.getElementById('purchase-confirm-dialog');
    const cancelButton = document.getElementById('cancel-purchase');
    const confirmButton = document.getElementById('confirm-purchase');

    if (!form || !dialog || !cancelButton || !confirmButton) {
        return;
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!form.reportValidity()) {
            return;
        }

        dialog.showModal();
    });

    cancelButton.addEventListener('click', () => {
        dialog.close();
    });

    confirmButton.addEventListener('click', () => {
        form.submit();
    });
});