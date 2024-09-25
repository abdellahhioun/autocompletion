document.getElementById('search').addEventListener('input', function() {
    const query = this.value;
    const suggestionsDiv = document.getElementById('suggestions');
    
    if (query.length > 0) {
        fetch(`suggestions.php?search=${query}`)
            .then(response => response.json())
            .then(data => {
                suggestionsDiv.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'suggestion';
                        div.textContent = item.nom;
                        div.onclick = () => {
                            document.getElementById('search').value = item.nom;
                            suggestionsDiv.innerHTML = '';
                        };
                        suggestionsDiv.appendChild(div);
                    });
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            });
    } else {
        suggestionsDiv.innerHTML = '';
        suggestionsDiv.style.display = 'none';
    }
});