const pokemonList = document.getElementById('pokemon-list');


fetch('https://pokeapi.co/api/v2/pokemon?limit=1000')
    .then(response => response.json())
    .then(data => {
        const pokemons = data.results;
        pokemons.forEach(pokemon => {
            fetchPokemonData(pokemon.url);
        });
    })
    .catch(error => console.log('Error fetching Pokémon list:', error));


function fetchPokemonData(url) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const pokemonInfo = document.createElement('div');
            pokemonInfo.classList.add('pokemon-info');
            pokemonInfo.innerHTML = `
                <h2>${data.name.toUpperCase()}</h2>
                <img src="${data.sprites.front_default}" alt="${data.name}">
                <p><strong>Height:</strong> ${data.height / 10} meters</p>
                <p><strong>Weight:</strong> ${data.weight / 10} kilograms</p>
                <p><strong>Abilities:</strong> ${data.abilities.map(ability => ability.ability.name).join(', ')}</p>
                <p><strong>Types:</strong> ${data.types.map(type => type.type.name).join(', ')}</p>
            `;
            pokemonList.appendChild(pokemonInfo);
        })
        .catch(error => console.log('Error fetching Pokémon data:', error));
}
