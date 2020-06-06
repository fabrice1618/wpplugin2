//alert("Demmarage widget");
getNiveau();

function getNiveau()
{
    // Coordonées GPS de Saint de Luz
  const lat = 43.4;
  const lng = -1.68;
  
  // Appel API
  fetch(`https://api.stormglass.io/v2/tide/sea-level/point?lat=${lat}&lng=${lng}&start=2020-06-06&end=2020-06-07`, {
    headers: {
      'Authorization': '1d81e23c-a6af-11ea-954a-0242ac130002-1d81e368-a6af-11ea-954a-0242ac130002'
    }
  }).then((response) => response.json()).then((tideData) => {
//        console.log(tideData['data']);

    // MAJ du DOM -> contenu HTML de la page
      tideData['data'].forEach(function (item, index) {
          cellule = document.getElementById('niv'+index);   // 'niv' + '3'
          cellule.textContent = item['sg'] + ' m';
      });


  });
}
