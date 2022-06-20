$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listarEstadoCivil();
})

///////////////////////////////////////////////////////////////////////
var tbl_estado_civil;
function listarEstadoCivil() {
    tbl_estado_civil = $("#tbl-estado-civil").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/estado_civil/controlador_listar_estado_civil.php",
            type: 'POST'
        },

        "columns": [
            /* Datos que se va a traer en el procedimiento almacenado */
            { "defaultContent": "" },
            { "data": "denominacion_ec" },

            {
                "data": "abreviatura_ec",
            },
            {
                "data": "estado_ec",
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
    tbl_estado_civil.on('draw.td', function () {
        var PageInfo = $("#tbl-estado-civil").DataTable().page.info();
        tbl_estado_civil.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}
///////////////////////////////////////////////////////////////////////

function registrarEstadoCivil(){
    const form= new FormData(document.querySelector('#form-registrar-estado-civil'));
    console.log(form.get('denominacion'))
    if (form.get('denominacion').length==0 || form.get('abreviatura').length==0){
        ValidarInputRegistroEstadoCivil("id_denominacion_registrar","id_abreviatura_registrar","valid_denominacion_registrar", "valid_abreviatura_registrar");
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({

            url: '../controller/estado_civil/controlador_registrar_estado_civil.php',
            type: 'POST',
            data: {
                denominacion:form.get('denominacion').trim(),
                abreviatura:form.get('abreviatura').trim(),
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalEstadoCivilRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Estado Civil Registrado", "success").then((value) => {
                        $("#modal-registro-estado-civil").modal('hide');
                        tbl_estado_civil.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este estado civil ya esta Registrado", "warning");
                }
    
            
        })
    }

    
}
///////////////////////////////////////////////////////////////////////

function ValidarInputRegistroEstadoCivil(denominacion, abreviatura,valid_denominacion_registrar,valid_abreviatura_registrar) {
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
    if (abreviatura != "") {
        if (document.getElementById(abreviatura).value.length > 0) {
            $("#" + abreviatura).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_abreviatura_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_abreviatura_registrar).innerHTML = '<b>DENOMINACIÓN CORRECTO</b>';
        }
        else {
            $("#" + abreviatura).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_abreviatura_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_abreviatura_registrar).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    
}
///////////////////////////////////////////////////////////////////////
var id_ec=0;
$('#tbl-estado-civil').on('click', '.editar', function () {
    var data = tbl_estado_civil.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_estado_civil.row(this).child.isShown()) {
        var data = tbl_estado_civil.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal-modificar-estado-civil").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal-modificar-estado-civil").modal('show');
    document.getElementById('id_denominacion_modificar').value = data["denominacion_ec"];
    document.getElementById('id_abreviatura_modificar').value = data["abreviatura_ec"];
    //document.getElementById('id_estado_editar').value = data["estado_ec"];
    id_ec= data["id_ec"];
    //document.getElementById('txt_contra_repetir').value = data["usu_email"];
    $('#id_estado_editar').select2().val(data["estado_ec"]).trigger('change.select2');
    //$('#select_estado_editar').select2().val(data["usua_estado"]).trigger('change.select2');
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    //idusuc = document.getElementById('txt_idUsu_editar').value;

})

///////////////////////////////////////////////////////////////////////

function modificarEstadoCivil(){
    console.log("d")
    const form= new FormData(document.querySelector('#form-modificar-estado-civil'));
    if (form.get('denominacion').length==0 || form.get('abreviatura').length==0){
        ValidarInputRegistroEstadoCivil("id_denominacion_modificar","id_abreviatura_modificar","valid_denominacion_modificar", "valid_abreviatura_modificar");
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({
            
            url: '../controller/estado_civil/controlador_modificar_estado_civil.php',
            type: 'POST',
            data: {
                id:id_ec,
                denominacion:form.get('denominacion').trim(),
                abreviatura:form.get('abreviatura').trim(),
                estado:form.get('estado').trim()
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalEstadoCivilRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Estado Civil Modificado", "success").then((value) => {
                        $("#modal-modificar-estado-civil").modal('hide');
                        tbl_estado_civil.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este estado civil ya esta Registrado", "warning");
                }
    
            
        })
    }

    
}

///////////////////////////////////////////////////////////////////////

function limpiar_modalEstadoCivilRegistrado() {
    document.getElementById("id_denominacion_registrar").value = "";
    document.getElementById("id_abreviatura_registrar").value = "";
    id_ec=0
}