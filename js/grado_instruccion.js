$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listarGradoInstruccion();
})

///////////////////////////////////////////////////////////////////////
var tbl_grado_instruccion;
function listarGradoInstruccion() {
    tbl_grado_instruccion = $("#tbl-grado-instruccion").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/grado_instruccion/controlador_listar_grado_instruccion.php",
            type: 'POST'
        },

        "columns": [
            /* Datos que se va a traer en el procedimiento almacenado */
            { "defaultContent": "" },
            { "data": "denominacion_gi" },
            {
                "data": "estado_gi",
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
    tbl_grado_instruccion.on('draw.td', function () {
        var PageInfo = $("#tbl-grado-instruccion").DataTable().page.info();
        tbl_grado_instruccion.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}
///////////////////////////////////////////////////////////////////////

function registrarGradoInstruccion(){
    const form= new FormData(document.querySelector('#form-registrar-grado-instruccion'));
    console.log(form.get('denominacion'))
    if (form.get('denominacion').length==0){
        ValidarInputRegistroGradoInstruccion("id_denominacion_registrar","valid_denominacion_registrar",);
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({

            url: '../controller/grado_instruccion/controlador_registrar_grado_instruccion.php',
            type: 'POST',
            data: {
                denominacion:form.get('denominacion').trim(),
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalGradoInstruccionRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Grado de Instrucción Registrado", "success").then((value) => {
                        $("#modal-registro-grado-instruccion").modal('hide');
                        tbl_grado_instruccion.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este grado de instrucción ya esta Registrado", "warning");
                }
    
            
        })
    }
}

///////////////////////////////////////////////////////////////////////
function ValidarInputRegistroGradoInstruccion(denominacion, valid_denominacion_registrar) {
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
///////////////////////////////////////////////////////////////////////
var id_gi=0;
$('#tbl-grado-instruccion').on('click', '.editar', function () {
    var data = tbl_grado_instruccion.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_grado_instruccion.row(this).child.isShown()) {
        var data = tbl_grado_instruccion.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal-modificar-grado-instruccion").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal-modificar-grado-instruccion").modal('show');
    document.getElementById('id_denominacion_modificar').value = data["denominacion_gi"];
    //document.getElementById('id_estado_editar').value = data["estado_ec"];
    id_gi= data["id_gi"];
    //document.getElementById('txt_contra_repetir').value = data["usu_email"];
    $('#id_estado_editar').select2().val(data["estado_gi"]).trigger('change.select2');
    //$('#select_estado_editar').select2().val(data["usua_estado"]).trigger('change.select2');
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    //idusuc = document.getElementById('txt_idUsu_editar').value;

})
///////////////////////////////////////////////////////////////////////

function modificarGradoInstruccion(){
    const form= new FormData(document.querySelector('#form-modificar-grado-instruccion'));
    if (form.get('denominacion').length==0){
        ValidarInputRegistroGradoInstruccion("id_denominacion_modificar","valid_denominacion_modificar",);
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }else{
        $.ajax({
            
            url: '../controller/grado_instruccion/controlador_modificar_grado_instruccion.php',
            type: 'POST',
            data: {
                id:id_gi,
                denominacion:form.get('denominacion').trim(),
                estado:form.get('estado').trim()
            }
        }).done(function (resp) {
                if (resp == 1) {
                    limpiar_modalGradoInstruccionRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Nuevo Grado de Instrucción Modificado", "success").then((value) => {
                        $("#modal-modificar-grado-instruccion").modal('hide');
                        tbl_grado_instruccion.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Este grado de instrucción ya esta Registrado", "warning");
                }
    
            
        })
    }

    
}
function limpiar_modalGradoInstruccionRegistrado() {
    document.getElementById("id_denominacion_registrar").value = "";
    id_gi=0;
}