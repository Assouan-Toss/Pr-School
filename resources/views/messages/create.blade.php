@extends('layouts.app')
@section('content')
<form action="{{ route('messages.send') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="receiver-search">Rechercher un destinataire</label>
        <input 
            type="text" 
            id="receiver-search" 
            class="search-input" 
            placeholder="Tapez le nom de l'utilisateur..."
            autocomplete="off"
        >
        
        <div id="search-results" class="search-results"></div>
        
        <label for="receiver_id">Destinataire sélectionné</label>
        <select name="receiver_id" id="receiver_id" required>
            <option value="">Sélectionnez un destinataire</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }} ({{ $user->role }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="contenu">Message</label>
        <textarea name="contenu" id="contenu" required></textarea>
    </div>

    <button type="submit">Envoyer</button>
</form>

<style>
.search-input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 8px;
}

.search-results {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    display: none;
    position: absolute;
    background: white;
    width: calc(100% - 24px);
    z-index: 1000;
}

.search-result-item {
    padding: 10px 15px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

.search-result-item:hover {
    background-color: #f5f5f5;
}

.search-result-item:last-child {
    border-bottom: none;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: bold;
}

.user-role {
    font-size: 0.9em;
    color: #666;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('receiver-search');
    const searchResults = document.getElementById('search-results');
    const receiverSelect = document.getElementById('receiver_id');
    
    // Cache les options originales pour les restaurer si nécessaire
    const originalOptions = Array.from(receiverSelect.options);
    
    // Fonction de recherche
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm.length < 2) {
            searchResults.style.display = 'none';
            restoreOriginalOptions();
            return;
        }
        
        // Filtrer les utilisateurs
        const filteredUsers = originalOptions.filter(option => {
            if (option.value === '') return false;
            const text = option.text.toLowerCase();
            return text.includes(searchTerm);
        });
        
        // Afficher les résultats
        displaySearchResults(filteredUsers);
    });
    
    function restoreOriginalOptions() {
        receiverSelect.innerHTML = '';
        originalOptions.forEach(option => {
            receiverSelect.appendChild(option.cloneNode(true));
        });
    }
    
    function displaySearchResults(users) {
        // Mettre à jour le select
        receiverSelect.innerHTML = '<option value="">Sélectionnez un destinataire</option>';
        users.forEach(user => {
            receiverSelect.appendChild(user.cloneNode(true));
        });
        
        // Afficher les résultats en dessous de l'input (optionnel)
        searchResults.innerHTML = '';
        
        if (users.length === 0) {
            const noResult = document.createElement('div');
            noResult.className = 'search-result-item';
            noResult.textContent = 'Aucun utilisateur trouvé';
            searchResults.appendChild(noResult);
        } else {
            users.forEach(user => {
                if (user.value === '') return;
                
                const resultItem = document.createElement('div');
                resultItem.className = 'search-result-item';
                
                // Extraire le nom et le rôle du texte de l'option
                const text = user.text;
                const match = text.match(/^(.*?)\s*\((.*?)\)$/);
                
                resultItem.innerHTML = `
                    <div class="user-info">
                        <span class="user-name">${match ? match[1] : text}</span>
                        <span class="user-role">${match ? match[2] : ''}</span>
                    </div>
                `;
                
                resultItem.addEventListener('click', function() {
                    receiverSelect.value = user.value;
                    searchInput.value = match ? match[1] : text;
                    searchResults.style.display = 'none';
                });
                
                searchResults.appendChild(resultItem);
            });
        }
        
        searchResults.style.display = 'block';
    }
    
    // Cacher les résultats quand on clique ailleurs
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.mb-4')) {
            searchResults.style.display = 'none';
        }
    });
    
    // Fermer les résultats avec la touche Échap
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            searchResults.style.display = 'none';
        }
    });
});
</script>
@endsection