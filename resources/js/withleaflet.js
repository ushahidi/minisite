require("./bootstrap");
require("./material-ui-custom");

import Leaflet from "leaflet";
let enabledMap = null;
const setupMap = (mapElement, info) => {
    if (enabledMap) {
        enabledMap.remove();
        enabledMap._container.style.display = 'none';
    }
    enabledMap = Leaflet.map(mapElement.dataset.osmId).setView([info.latitude, info.longitude], 13);
    Leaflet.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        minZoom: 4,
        id: 'rowasc/ck8rs2pcn0hdc1imppdvz3cv1',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicm93YXNjIiwiYSI6ImNrOHJyeGt0OTA5NWQzbG16YjBlZHd2ZWYifQ.ahwtODogaOTsVrVm7Jba9g'
    }).addTo(enabledMap);
    enabledMap._container.style.display='block';
    enabledMap.dragging.disable();
    enabledMap.zoomControl.remove();
    enabledMap.touchZoom.disable();
    enabledMap.doubleClickZoom.disable();
    enabledMap.scrollWheelZoom.disable();
    enabledMap.boxZoom.disable();
    enabledMap.keyboard.disable();
    enabledMap.fitBounds([
        [info.bounds.south, info.bounds.west],
        [info.bounds.north, info.bounds.east],
    ]);
}

if (document.querySelectorAll(".location-selector").length >0 ) {
    document.querySelectorAll(".location-selector").forEach(
        ls => { ls.addEventListener('click', (e) => {
            if (e.target.dataset.osmId && e.target.checked) {
                const info = JSON.parse(e.target.value);
                document.getElementById(e.target.dataset.osmId).setAttribute("style","width:100%;height:180px;");
                setupMap(e.target, info);
            }
        })
    })
}
