$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listarTipoTramite();
})
///////////////////////////////////////////////////////////////////////
var tbl_tipo_tramite;
function listarTipoTramite() {
    tbl_tipo_tramite = $("#tbl-tipo-tramite").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/tipo_tramite/controlador_listar_tipo_tramite.php",
            type: 'POST'
        },

        "columns": [
            /* Datos que se va a traer en el procedimiento almacenado */
            { "defaultContent": "" },
            { "data": "denominacion_tm" },
            {
                "data": "estado_tm",
                render: function (data, type, row) {
                    if (data == "A") {
                        return "<span class='badge bg-success'>Activo</span>";
                    } else {
                        return '<span class="badge bg-danger">Inactivo</span>';
                    }
                }
            },

            { "defaultContent": "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>" },
        ],

        "languaje": idioma_espanol,
        select: true
    });
    tbl_tipo_tramite.on('draw.td', function () {
        var PageInfo = $("#tbl-tipo-tramite").DataTable().page.info();
        tbl_tipo_tramite.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

///////////////////////////////////////////////////////////////////////

function registrarTipoTramite(){
    const form= new FormData(document.querySelector('#form-registrar-tipo-tramite'));
    if (form.get('denominacion').length==0){
        ValidarInputRegistroTipoTramite("id_denominacion_registrar","valid_denominacion_registrar",);
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({

            url: '../controller/tipo_tramite/controlador_registrar_tipo_tramite.php',
            type: 'POST',
            data: {
                denominacion:form.get('denominacion').trim(),
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalTipoTramiteRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Tipo de Trámite Registrado", "success").then((value) => {
                        $("#modal-registro-tipo-tramite").modal('hide');
                        tbl_tipo_tramite.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este tipo de trámite ya esta Registrado", "warning");
                }
        })
    }
}
///////////////////////////////////////////////////////////////////////
function ValidarInputRegistroTipoTramite(denominacion, valid_denominacion_registrar) {
    if (denominacion != "") {
        if (document.getElementById(denominacion).value.length > 0) {
            $("#" + denominacion).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_denominacion_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_denominacion_registrar).innerHTML = '<b>DENOMINACIÓN CORRECTO<b>';
        }
        else {
            $("#" + denominacion).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_denominacion_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_denominacion_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    
}
var id_tt=0;
$('#tbl-tipo-tramite').on('click', '.editar', function () {
    var data = tbl_tipo_tramite.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_tipo_tramite.row(this).child.isShown()) {
        var data = tbl_tipo_tramite.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal-modificar-tipo-tramite").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal-modificar-tipo-tramite").modal('show');
    document.getElementById('id_denominacion_modificar').value = data["denominacion_tm"];
    //document.getElementById('id_estado_editar').value = data["estado_ec"];
    id_tt= data["id_tm"];
    //document.getElementById('txt_contra_repetir').value = data["usu_email"];
    $('#id_estado_editar').select2().val(data["estado_tm"]).trigger('change.select2');
    //$('#select_estado_editar').select2().val(data["usua_estado"]).trigger('change.select2');
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    //idusuc = document.getElementById('txt_idUsu_editar').value;

})
///////////////////////////////////////////////////////////////////////

function modificarTipoTramite(){
    const form= new FormData(document.querySelector('#form-modificar-tipo-tramite'));
    console.log(form.get('estado').trim());
    if (form.get('denominacion').length==0){
        ValidarInputRegistroTipoTramite("id_denominacion_modificar","valid_denominacion_modificar",);
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({        
            url: '../controller/tipo_tramite/controlador_modificar_tipo_tramite.php',
            type: 'POST',
            data: {
                id:id_tt,
                denominacion:form.get('denominacion').trim(),
                estado:form.get('estado').trim()
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalTipoTramiteModificado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Tipo de Trámite Modificado", "success").then((value) => {
                        $("#modal-modificar-grado-instruccion").modal('hide');
                        tbl_tipo_tramite.ajax.reload(); 
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este Tipo de Trámite ya esta Registrado", "warning");
                }        
        })
    }
}
///////////////////////////////////////////////////////////////////////
function limpiar_modalTipoTramiteRegistrado() {
    document.getElementById("id_denominacion_registrar").value = "";
    id_tt=0;
}
function limpiar_modalTipoTramiteModificado() {
    document.getElementById("id_denominacion_modificar").value = "";
    id_tt=0;
}