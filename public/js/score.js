console.log('le fichier est bien chargé')

// Fonction asynchrone pour récupérer et afficher les scores
async function fetchAndDisplayScores() {
    try {
        
        // Effectue une requête GET vers l'API
        const response = await fetch('http://localhost:8000/api/score');
        
        // Vérifie si la réponse est OK (statut 200-299)
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        // Convertit la réponse en JSON
        const scores = await response.json();
        
        // Appelle la fonction pour afficher les scores
        displayScores(scores);
    } catch (error) {
        // Gère les erreurs potentielles
        console.error('Erreur lors de la récupération des scores:', error);
    }
}

// Fonction pour afficher les scores dans le DOM
function displayScores(scores) {
    scores.forEach(score => {
        // Sélectionne l'élément de résultat pour chaque match
        const resultInput = document.getElementById(`result1-match${score.id}`);

        // Met à jour la valeur du résultat si l'élément existe
        if (resultInput) {
            resultInput.value = score.result;
        }
    });
}

// Appelle la fonction fetchAndDisplayScores quand le DOM est entièrement chargé
document.addEventListener('DOMContentLoaded', fetchAndDisplayScores);

// Optionnel: Rafraîchissement périodique des scores
// setInterval(fetchAndDisplayScores, 30000); // Toutes les 30 secondes