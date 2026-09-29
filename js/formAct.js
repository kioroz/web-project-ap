document.getElementById('content').addEventListener('submit', function (e) {
    if (e.target.id !== 'formActivite') return; // ignore les autres formulaires éventuels

    e.preventDefault();
    const form = e.target;

    fetch('../pageActiv/gererActiv.php', { // même fichier PHP que celui qui affiche le formulaire
        method: 'POST',
        body: new FormData(form)
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('content').innerHTML = html;
    })
    .catch(err => console.error('Erreur AJAX :', err));
});