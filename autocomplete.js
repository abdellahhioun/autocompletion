document.getElementById('search-input').addEventListener('input', function() {
    const query = this.value;
  
    if (query.length > 0) {
      fetch(`autocomplete.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
          const exactMatches = data.exactMatches;
          const partialMatches = data.partialMatches;
  
          const list = document.getElementById('autocomplete-list');
          list.innerHTML = '';
  
          if (exactMatches.length > 0) {
            exactMatches.forEach(item => {
              const div = document.createElement('div');
              div.innerHTML = `<img src='${item.image}' alt='${item.name}' style='width: 50px; height: 50px; vertical-align: middle;'> ${item.name}`;
              list.appendChild(div);
            });
          }
  
          if (partialMatches.length > 0) {
            const separator = document.createElement('div');
            separator.classList.add('separator');
            separator.textContent = '---';
            list.appendChild(separator);
  
            partialMatches.forEach(item => {
              const div = document.createElement('div');
              div.innerHTML = `<img src='${item.image}' alt='${item.name}' style='width: 50px; height: 50px; vertical-align: middle;'> ${item.name}`;
              list.appendChild(div);
            });
          }
        });
    }
  });
  