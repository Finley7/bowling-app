let form = document.getElementById('player-form');
let playerButton = document.getElementById('add-player-button');
let playerList = document.getElementById('player-list');

let formTemplate = `
<div>
    <label for="__player__" class="block font-medium text-sm text-gray-700">Player __count__</label>
    <input required id="__player__" placeholder="Name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" name="__player__"/>
</div>`;
playerButton.addEventListener('click', () => {
    let playerCount = playerList.children.length;

    if(playerCount === 6) {
        alert('There can only be 6 players per lane!');
        return;
    }

    let updatedFormTemplate = formTemplate.replaceAll('__player__', 'player_' + playerCount);
    updatedFormTemplate = updatedFormTemplate.replace('__count__', playerCount + 1);
    playerList.innerHTML += updatedFormTemplate;
})
