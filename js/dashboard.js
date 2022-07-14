$(document).ready(function(){
    numeroTramites();
    numeroPersonasXtipo();
})
async function numeroPersonasXtipo(){
    try {
        const response = await fetch('../controller/persona/controlador_listar_persona.php');
        const result = await response.json()
        let contadorB=0;
        let contadorR=0;
        if (result.data==undefined) {
            contadorB=0;
            contadorR=0;
        } else {
            for (let i = 0; i < result.data.length; i++) {
                if (result.data[i]['tipo_pe']=="B") {
                    contadorB++;
                } else {
                    contadorR++;
                }
            }
        }
        document.querySelector('#id_num_bene').textContent=contadorB;
        document.querySelector('#id_num_repre').textContent=contadorR;
    } catch (error) {
        
    }
}

async function numeroTramites(){
    const f = new Date();
    const fecha=f.getFullYear()+ "-" + (f.getMonth() +1) + "-" +f.getDate();
    try {
        const response = await fetch('../controller/tramite/controlador_listar_tramite.php');
        const result= await response.json();
        console.log(result)
        let contadorTramHoy=0;
        let contadorTotal=0;
        for (let i = 0; i < result.length; i++) {
            if (result[i]['fecha_t']==fecha) {
                contadorTramHoy++;
            }
            contadorTotal++
        }
        document.querySelector('#id_tram_hoy').textContent=contadorTramHoy;
        document.querySelector('#id_tram_total').textContent=contadorTotal;
    } catch (error) {
        console.log(error);
    }
}