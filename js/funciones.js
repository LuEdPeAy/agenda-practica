async function activeItemList(){
    let listaContactos = document.getElementsByClassName('itemContactos');

    for(let i=0; i<=listaContactos.length; i++){
        console.log(listaContactos[i].getAttribute('idb'))   ;
    }
}