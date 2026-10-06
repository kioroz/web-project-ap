document.getElementById('content').addEventListener('submit', function (e) {
    if (e.target.id !== 'formAnimation') return; // on ignore les autres formulaires

    e.preventDefault();
    const form = e.target;

    fetch('../pageAnim/ajoutAnim.php', { 
        method: 'POST',
        body: new FormData(form)
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('content').innerHTML = html;
    })
    .catch(err => console.error('Erreur AJAX :', err));
});
