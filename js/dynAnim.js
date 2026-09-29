function loadPage(page) {
    fetch("../pageAnim/" + page + ".php")
        .then(res => res.text())
        .then(html => {
            document.getElementById("content").innerHTML = html;
        });
}
document.querySelectorAll('#menu li[data-role]').forEach(item => {
    item.addEventListener('click', () => {
        loadPage(item.dataset.role);
    });
});
