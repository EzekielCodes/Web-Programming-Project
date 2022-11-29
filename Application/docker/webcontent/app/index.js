const searchInput = document.getElementById('search');
const resultList = document.getElementById('result-list');
const mapContainer = document.getElementById('map-container');
const currentMarkers = [];
$latidute = $longitude = "";
$latidute_err = $longitude_err = "";

const map = L.map(mapContainer).setView([20.13847, 1.40625], 2);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

document.getElementById('search-button').addEventListener('click', () => {
    const query = searchInput.value;
    fetch('http://localhost:8080/search?q=' + query)
        .then(result => result.json())
        .then(parsedResult => {            
            setResultList(parsedResult);
        });
});

document.getElementById('save-button').addEventListener('click', () => {
    console.log("save clicked");
    console.log(latidute);
    console.log(longitude);
    
});

function setResultList(parsedResult) {
    resultList.innerHTML = "";
    for (const marker of currentMarkers) {
        map.removeLayer(marker);
    }
    map.flyTo(new L.LatLng(20.13847, 1.40625), 2);
    for (const result of parsedResult) { 
        latidute = result.lat;
        longitude = result.lon;      
        const li = document.createElement('li');
        li.classList.add('list-group-item', 'list-group-item-action');
        li.innerHTML = JSON.stringify({
            displayName: result.display_name,
            lat: result.lat,
            lon: result.lon
        }, undefined, 2);
        li.addEventListener('click', (event) => {
            for(const child of resultList.children) {
                child.classList.remove('active');
            }
            event.target.classList.add('active');
            const clickedData = JSON.parse(event.target.innerHTML);
            const position = new L.LatLng(clickedData.lat, clickedData.lon);
            map.flyTo(position, 10);
        })
        const position = new L.LatLng(result.lat, result.lon);
        currentMarkers.push(new L.marker(position).addTo(map));
        resultList.appendChild(li);
    }
   
}