$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listar();
    listarTipoTramite();
})

var tbl_tramite;
var id_perss=0;
function listarTramite(){
    tbl_tramite = $("#tbl-tramite").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/tramite/controlador_listar_tramite.php",
            type: 'POST'
        },

        "columns": [
            /* Datos que se va a traer en el procedimiento almacenado */
            { "defaultContent": "" },
            { "data": "id_t" },

            {"data": "tipo_t_denominacion"},
            {"data": "fecha_t"},
            {"data": "persona_t_nombre"},

            { "defaultContent": "<a href='' class='descargar btn btn-primary btn-sm'><i class='bi bi-cloud-download-fill'></i></a>"+
                                "<a href='' class='subir btn btn-warning btn-sm'><i class='bi bi-cloud-upload'></i></a>"
            },
        ],

        "languaje": idioma_espanol,
        select: true
    });
    tbl_tramite.on('draw.td', function () {
        var PageInfo = $("#tbl-tramite").DataTable().page.info();
        tbl_tramite.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}
async function listar(){
    try {
        const response = await fetch('../controller/tramite/controlador_listar_tramite.php');
        const result= await response.json()
        console.log(result)
        if ($.fn.DataTable.isDataTable('#tbl-tramite')) {
            $('#tbl-tramite').DataTable().destroy();
        }
        $('#tbl-tramite tbody').html("");
        for(i=0;i<result.length;i++){
            let den= result[i]['tipo_t_denominacion'];
            let fila = `<tr>`;
            fila += `<td>` + parseInt(i+1) + `</td>`;
            fila += `<td>` + result[i]['id_t'] + `</td>`;
            fila += `<td>` + result[i]['tipo_t_denominacion'] +`</td>`;
            fila += `<td>` + result[i]['fecha_t'] + `</td>`;
            fila += `<td>` + result[i]['persona_t_nombre'] + `</td>`;
            if (result[i]['archivo_t']=='') {
                fila += `<td>
                        <a href='../view/pdf_tramite/solicitud_inicial.php?${result[i]['id_t']}'  class='descargar btn btn-primary btn-sm'><i class='bi bi-cloud-download-fill'></i></a>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#upload" onclick="obtenerIDTramite(${result[i]['id_t']})"><i class='bi bi-cloud-upload-fill'></i></button>
                    </td>`;
            } else {
                fila += `<td>
                        <a href='../view/pdf_tramite/solicitud_inicial.php?${result[i]['id_t']}'  class='descargar btn btn-primary btn-sm'><i class='bi bi-cloud-download-fill'></i></a>
                        <a href='../uploads/${result[i]['archivo_t']}'  class='descargar btn btn-secondary btn-sm' target=_blank><i class="bi bi-eye-fill"></i></a>

                    </td>`;
                
            }
            

            fila += `</tr>`;
            tbl_persona2=$('#tbl-tramite tbody').append(fila);
                        
        }
            
        $('#tbl-tramite').DataTable({
            language: {
                decimal: "",
                emptyTable: "No hay información",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
                infoFiltered: "(Filtrado de _MAX_ total entradas)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ Entradas",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    next: "Siguiente",
                    previous: "Anterior",
                },
            },
            lengthMenu: [5, 10, 20],
        })

    } catch (error) {
        console.log(error);
    }
}
///////////////////////////////////////////////////////////////////////
$('#tbl-persona').on('descargar', '.editar', function () {
    var data = tbl_persona.row($(this).parents('tr')).data();
    if (tbl_persona.row(this).child.isShown()) {
        var data = tbl_persona.row(this).data();
    }
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})
///////////////////////////////////////////////////////////////////////
function listarTipoTramite(){
    let cboTT=document.querySelector("#tipo_tramite_regitrar");
    $.ajax({
        url: "../controller/tipo_tramite/controlador_listar_tipo_tramite.php",
        type: 'POST',
    }).done(function (response){
        const tp = JSON.parse(response);
        cboTT.innerHTML='';
        cboTT.innerHTML+=`<option value>SELECCIONE</option>`
        for (let i = 0; i < tp["data"].length; i++) {
            if (tp["data"][i]['estado_tm']=='A') {
                cboTT.innerHTML+=`<option value="${tp["data"][i]['id_tm']}">${tp["data"][i]['denominacion_tm']}</option>`
            }
        }
        
    })
}
///////////////////////////////////////////////////////////////////////
function registrarTramite(){

    const form= new FormData(document.querySelector('#form-registrar-tramite'));
    if (id_perss!=0) {
        if (form.get('tipo_tramite')!=0){
            id_user=document.querySelector('#txt_idPrincipal').value;
            const f = new Date();
            const fecha=f.getFullYear()+ "-" + (f.getMonth() +1) + "-" +f.getDate();
            $.ajax({
    
                url: '../controller/tramite/controlador_registrar_tramite.php',
                type: 'POST',
                data: {
                    fecha:fecha,
                    archivo:'',
                    id_titr:form.get('tipo_tramite'),
                    id_pers:id_perss,
                    id_usuario:id_user,
                }
            }).done(function (resp) {
                    if (resp == 'true') {
                        
                        return Swal.fire("Mensaje de Confirmacion", "Nuevo Trámite Registrado", "success").then((value) => {
                            $("#modal-registro-tramite").modal('hide');
                            limpiar_modalTramite();
                            listar()
        
                        });
                    }else {
                        return Swal.fire("Mensaje de Advertencia", "Error al registrar trámite", "warning");
                    }
        
                
            })
        }else{
            ValidarInputRegistroTramite('tipo_tramite_regitrar', 'valid_tipo_tramite_registrar');
            return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
        }
    } else {
        return Swal.fire("!Mensaje de Advertencia!", "<b>Busque a un beneficiario para registrar su trámite</b>", "warning");

    }
    

    
}
///////////////////////////////////////////////////////////////////////
function ValidarInputRegistroTramite(tipo_tramite_regitrar, valid_tipo_tramite_registrar) {
    if (tipo_tramite_regitrar != "") {
        if (document.getElementById(tipo_tramite_regitrar).value.length > 0) {
            $("#" + tipo_tramite_regitrar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_tipo_tramite_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_tipo_tramite_registrar).innerHTML = '<b>DENOMINACIÓN CORRECTO<b>';
        }
        else {
            $("#" + tipo_tramite_regitrar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_tipo_tramite_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_tipo_tramite_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    
}
///////////////////////////////////////////////////////////////////////
function buscarBeneficiario(){
    let dni=document.querySelector('#dni_registrar').value;
    let nombres=document.querySelector('#persona_registrar');
    if (dni.trim()!=''&&dni.trim().length==8) {
        $.ajax({
            url: '../controller/persona/controlador_buscar_tutor.php',
            type: 'POST',
            data: {
                dni:dni.trim()
            }
        }).done( function(resp){
            const nom=JSON.parse(resp)
            if (nom['data'].length>0) {
                if (nom['data'][0]['tipo']=='B') {
                    if(nom['data'][0]['estado']=='A'){
                        nombres.value=nom['data'][0]['nombre'];
                        indicador=true;
                        id_perss=nom['data'][0]['id_p'];
                    }else{
                        return Swal.fire("Mensaje de Advertencia", "El representante se encuentra de baja, actualice su estado para continuar", "warning");  
                    }
                    
                } else {
                    return Swal.fire("Mensaje de Advertencia", "DNI ingresada no existe como beneficiario", "warning"); 
                }
                        
            } else {
                return Swal.fire("Mensaje de Advertencia", "DNI ingresada no existe", "warning");  
            }
        })
    } else {
        return Swal.fire("Mensaje de Advertencia", "Ingrese un DNI válido de 8 caracteres", "warning");  
    }
}

function limpiar_modalTramite(){
    $('#tipo_tramite_regitrar').select2().val('').trigger('change.select2');
    document.querySelector('#dni_registrar').value='';
    document.querySelector('#persona_registrar').value='';
    id_perss=0;
}
function obtenerIDTramite(id){
    document.querySelector('#id_tramite').textContent=id;
    document.querySelector('#id_inp_tram').value=id;
}
///////////////////////////////////////////////////////////////////////

async function enviar(){
    const form = new FormData(document.querySelector('#form-file'));
    try {
        const response = await fetch('../controller/pdf/upload.php',{
            method:'POST',
            enctype:'multipart/form-data',
            body:form,
        })
        const result = await response.json()
        const {status} = result;
        const {mensaje}=result;
        if (status) {
            listar()
            Swal.fire('Éxito',mensaje,'success');
        } else {
            Swal.fire('Error',mensaje,'error');
        }
    } catch (error) {
        console.log(error);
    }
}