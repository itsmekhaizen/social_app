document.querySelectorAll('[data-confirm]').forEach(function (link) {
    link.addEventListener('click', function (event) {
        if (!confirm(link.dataset.confirm)) {
            event.preventDefault();
        }
    });
});
