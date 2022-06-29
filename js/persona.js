$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listarPersona();
    listarProvincia();
    listarGradoInstitucion();
    listarEstadoCivil();
})


var indicador=false;
var id_p=0;
var tbl_persona;
function listarPersona() {
    tbl_persona = $("#tbl-persona").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/persona/controlador_listar_persona.php",
            type: 'POST'
        },

        "columns": [
            /* Datos que se va a traer en el procedimiento almacenado */
            { "defaultContent": "" },
            { "data": "dni_pe" },
            { "data": "nombre_pe" },
            { "data": "apepat_pe" },
            { "data": "apemat_pe" },
            { "data": "fecha_pe" },
            {
                "data": "sexo_pe",
                render: function (data, type, row) {
                    if (data == "M") {
                        return "<span>Masculino</span>";
                    } else {
                        return '<span>Femenino</span>';
                    }
                }
            },
            
            
            { "data": "telefono_pe" },
            { "data": "correo_pe" },
            { "data": "numcertdisc" },
            {
                "data": "tipo_pe",
                render: function (data, type, row) {
                    if (data == "D") {
                        return "<span>Discapacitado(a)</span>";
                    } else {
                        return '<span>Representante</span>';
                    }
                }
            },
            {
                "data": "estado_pe",
                render: function (data, type, row) {
                    if (data == "A") {
                        return "<span class='badge bg-success'>Activo</span>";
                    } else {
                        return '<span class="badge bg-danger">Inactivo</span>';
                    }
                }
            },
            {
                "data": "dependiente_pe",
                render: function (data, type, row) {
                    if (data == 0) {
                        return "<span >NO</span>";
                    } else {
                        return '<span >SÍ</span>';
                    }
                }
            },
            
            { "data": "denominacion_esci" },
            { "data": "denominacion_grin" },
            { "data": "distrito_ubig" },

            { "defaultContent": "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>"+
                                "<button class='ver btn btn-secondary btn-sm'><i class='fa fa-edit'></i></button>"
            
            },
        ],

        "languaje": idioma_espanol,
        select: true
    });
    tbl_persona.on('draw.td', function () {
        var PageInfo = $("#tbl-persona").DataTable().page.info();
        tbl_persona.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}
function listarProvincia(){
    let slctProvincia = document.querySelector("#id_provincia_registrar");
    let slctProvinciaBeneficiario = document.querySelector("#id_provincia_registrar_beneficiario");

    let slctProvinciaModificar = document.querySelector("#id_provincia_modificar");
    let slctProvinciaBeneficiarioModificar = document.querySelector("#id_provincia_modificar_beneficiario");
    $.ajax({
        url: '../controller/ubigeo/controlador_listar_provincia_ubigeo.php',
        type: 'GET',
    }).done(function (response) {
        const provincia = JSON.parse(response);
        slctProvincia.innerHTML = '';
        slctProvinciaBeneficiario.innerHTML = '';

        slctProvinciaModificar.innerHTML = '';
        slctProvinciaBeneficiarioModificar.innerHTML = '';

        slctProvincia.innerHTML = '<option value="0">SELECCIONE</option>';
        slctProvinciaBeneficiario.innerHTML = '<option value="0">SELECCIONE</option>';

        slctProvinciaModificar.innerHTML = '<option value="0">SELECCIONE</option>';
        slctProvinciaBeneficiarioModificar.innerHTML = '<option value="0">SELECCIONE</option>';
        for (let i = 0; i < provincia["data"].length; i++) {
            
            slctProvincia.innerHTML += `
                            <option value="${provincia['data'][i]["provincia"]}">${provincia['data'][i]["provincia"]}</option>
                                    `;
            slctProvinciaBeneficiario.innerHTML += `
                            <option value="${provincia['data'][i]["provincia"]}">${provincia['data'][i]["provincia"]}</option>
                                            `;
            slctProvinciaModificar.innerHTML += `
                            <option value="${provincia['data'][i]["provincia"]}">${provincia['data'][i]["provincia"]}</option>
                                    `;
            slctProvinciaBeneficiarioModificar.innerHTML += `
                            <option value="${provincia['data'][i]["provincia"]}">${provincia['data'][i]["provincia"]}</option>
                                            `;
        }

    })
}

function listarEstadoCivil(){
    let slctEstadoCivil = document.querySelector("#id_estado_civil_registrar");
    let slctEstadoCivilBeneficiario=document.querySelector("#id_estado_civil_registrar_beneficiario");
    
    let slctEstadoCivilModificar=document.querySelector("#id_estado_civil_modificar");
    let slctEstadoCivilBeneficiarioModificar=document.querySelector("#id_estado_civil_modificar_beneficiario");

    $.ajax({
        url: '../controller/estado_civil/controlador_listar_estado_civil.php',
        type: 'GET',
    }).done(function (response) {
        const estadoCivil = JSON.parse(response);
        slctEstadoCivil.innerHTML = '';
        slctEstadoCivilBeneficiario.innerHTML='';

        slctEstadoCivilModificar.innerHTML='';
        slctEstadoCivilBeneficiarioModificar.innerHTML='';


        slctEstadoCivil.innerHTML = '<option value="0">SELECCIONE</option>';
        slctEstadoCivilBeneficiario.innerHTML = '<option value="0">SELECCIONE</option>';
        
        slctEstadoCivilModificar.innerHTML = '<option value="0">SELECCIONE</option>';
        slctEstadoCivilBeneficiarioModificar.innerHTML = '<option value="0">SELECCIONE</option>';

        for (let i = 0; i < estadoCivil["data"].length; i++) {
            
            slctEstadoCivil.innerHTML += `
                            <option value="${estadoCivil['data'][i]["id_ec"]}">${estadoCivil['data'][i]["denominacion_ec"]}</option>
                                    `;
            slctEstadoCivilBeneficiario.innerHTML += `
                            <option value="${estadoCivil['data'][i]["id_ec"]}">${estadoCivil['data'][i]["denominacion_ec"]}</option>
                            `;
            
            slctEstadoCivilModificar.innerHTML += `
                            <option value="${estadoCivil['data'][i]["id_ec"]}">${estadoCivil['data'][i]["denominacion_ec"]}</option>
                                    `;
            slctEstadoCivilBeneficiarioModificar.innerHTML += `
                            <option value="${estadoCivil['data'][i]["id_ec"]}">${estadoCivil['data'][i]["denominacion_ec"]}</option>
                            `;
        }
    })

}


function listarGradoInstitucion(){
    let slctGradoInstitucion = document.querySelector("#id_grado_instruccion_registrar");
    let slctGradoInstitucionBeneficiario = document.querySelector("#id_grado_instruccion_registrar_beneficiario");

    let slctGradoInstitucionModificar = document.querySelector("#id_grado_instruccion_modificar");
    let slctGradoInstitucionBeneficiarioModificar = document.querySelector("#id_grado_instruccion_modificar_beneficiario");
    
    
    $.ajax({
        url: '../controller/grado_instruccion/controlador_listar_grado_instruccion.php',
        type: 'GET',
    }).done(function (response) {
        const gradoInstitucion = JSON.parse(response);
        slctGradoInstitucion.innerHTML = '';
        slctGradoInstitucionBeneficiario.innerHTML='';

        slctGradoInstitucionModificar.innerHTML = '';
        slctGradoInstitucionBeneficiarioModificar.innerHTML='';

        slctGradoInstitucion.innerHTML = '<option value="0">SELECCIONE</option>';
        slctGradoInstitucionBeneficiario.innerHTML = '<option value="0">SELECCIONE</option>';

        slctGradoInstitucionModificar.innerHTML = '<option value="0">SELECCIONE</option>';
        slctGradoInstitucionBeneficiarioModificar.innerHTML = '<option value="0">SELECCIONE</option>';
        for (let i = 0; i < gradoInstitucion["data"].length; i++) {
            
            slctGradoInstitucion.innerHTML += `
                            <option value="${gradoInstitucion['data'][i]["id_gi"]}">${gradoInstitucion['data'][i]["denominacion_gi"]}</option>
                                    `;
            slctGradoInstitucionBeneficiario.innerHTML += `
                            <option value="${gradoInstitucion['data'][i]["id_gi"]}">${gradoInstitucion['data'][i]["denominacion_gi"]}</option>
                                    `;
            slctGradoInstitucionModificar.innerHTML += `
                            <option value="${gradoInstitucion['data'][i]["id_gi"]}">${gradoInstitucion['data'][i]["denominacion_gi"]}</option>
                                            `;
            slctGradoInstitucionBeneficiarioModificar.innerHTML += `
                            <option value="${gradoInstitucion['data'][i]["id_gi"]}">${gradoInstitucion['data'][i]["denominacion_gi"]}</option>
                                            `;
        }
    })

}
function listarDistritoXprovinciaTutor(){
    var valSelect=document.querySelector('#id_provincia_registrar').value;
    if (valSelect!=0) {
        let slctDistrito = document.querySelector("#id_distrito_registrar");
        $.ajax({
            url: '../controller/ubigeo/controlador_listar_distritoXprovincia.php',
            type: 'POST',
            data: {
                provincia:valSelect,
            }
        }).done(function (response) {
            const distrito = JSON.parse(response);
            slctDistrito.innerHTML = '';
            slctDistrito.innerHTML = '<option value="0">SELECCIONE</option>';
            for (let i = 0; i < distrito["data"].length; i++) {
                slctDistrito.innerHTML+=`
                    <option value="${distrito['data'][i]["distrito"]}">${distrito['data'][i]["distrito"]}</option>
                `;
            }
        })
    }
    

}
function listarDistritoXprovinciaBeneficiario(){
    var valSelect=document.querySelector('#id_provincia_registrar_beneficiario').value;
    if (valSelect!=0) {
        console.log(valSelect)
        let slctDistrito = document.querySelector("#id_distrito_registrar_beneficiario");
        $.ajax({
            url: '../controller/ubigeo/controlador_listar_distritoXprovincia.php',
            type: 'POST',
            data: {
                provincia:valSelect,
            }
        }).done(function (response) {
            const distrito = JSON.parse(response);
            slctDistrito.innerHTML = '';
            slctDistrito.innerHTML = '<option value="0">SELECCIONE</option>';
            for (let i = 0; i < distrito["data"].length; i++) {
                slctDistrito.innerHTML+=`
                    <option value="${distrito['data'][i]["distrito"]}">${distrito['data'][i]["distrito"]}</option>
                `;
            }
        })
    }
    

}
function registrarTutor(){
    const form= new FormData(document.querySelector('#form-registrar-persona-tutor'));
    if (form.get('dni').trim()!='' &&form.get('nombre').trim()!=''&&form.get('apepat').trim()!=''&&form.get('apemat').trim()!=''
    &&form.get('fechanac').trim()!=''&&form.get('sexo').trim()!=0&&form.get('telefono').trim()!=''&&form.get('correo').trim()!=''
    &&form.get('estado_civil').trim()!=0&&form.get('grado_instruccion').trim()!=0&&form.get('provincia').trim()!=0&&form.get('distrito').trim()!=0

    ){
        $.ajax({

            url: '../controller/persona/controlador_registrar_persona.php',
            type: 'POST',
            data: {
                dni:form.get('dni').trim(),
                nombre:form.get('nombre').trim(),
                apepat:form.get('apepat').trim(),
                apemat:form.get('apemat').trim(),
                fechanac:form.get('fechanac').trim(),
                sexo:form.get('sexo').trim(),
                telefono:form.get('telefono').trim(),
                correo:form.get('correo').trim(),
                numcert:null,
                tipo:'R',
                dependiente:0,
                id_esci:form.get('estado_civil').trim(),
                id_grin:form.get('grado_instruccion').trim(),
                distrito:form.get('distrito').trim(),
            }
        }).done(function (resp) {
                if (resp == 1) {
                    //limpiar_modalTipoTramiteRegistrado();
                    return Swal.fire("Mensaje de Confirmacion", "Persona representante registrado correctamente", "success").then((value) => {
                        //$("#modal-registro-tipo-tramite").modal('hide');
                        tbl_persona.ajax.reload();
    
                    });
                }else if (resp == 2) {
                    return Swal.fire("Mensaje de Advertencia", "Esta persona ya está registrada", "warning");
                }
        })
        
    }else{
        
        ValidarInputRegistroTutor(
            'id_dni_registrar', 'valid_dni_registrar','id_nombre_registrar','valid_nombre_registrar',
            'id_apepat_registrar', 'valid_apepat_registrar','id_apemat_registrar', 'valid_apemat_registrar','id_fechanac_registrar','valid_fechanac_registrar',
            'id_sexo_registrar','valid_sexo_registrar','id_telefono_registrar','valid_telefono_registrar','id_correo_registrar','valid_correo_registrar','id_estado_civil_registrar',
            'valid_estado_civil_registrar', 'id_grado_instruccion_registrar','valid_grado_instruccion_registrar','id_provincia_registrar','valid_provincia_registrar','id_distrito_registrar','valid_distrito_registrar'
        );
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }

}

function ValidarInputRegistroTutor(dni, valid_dni_registrar,nombre,valid_nombre_registrar,
    apepat, valid_apepat_registrar,apemat, valid_apemat_registrar,fechanac,valid_fechanac_registrar,
    sexo,valid_sexo_registrar,telefono,valid_telefono_registrar,correo,valid_correo_registrar,estado_civil,
    valid_estado_civil_registrar, grado_instruccion,valid_grado_instruccion_registrar,provincia,valid_provincia_registrar,distrito,valid_distrito_registrar

    
    ) {
    if (dni != "") {
        if (document.getElementById(dni).value.length > 0) {
            $("#" + dni).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_dni_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_dni_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + dni).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_dni_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_dni_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (nombre != "") {
        if (document.getElementById(nombre).value.length > 0) {
            $("#" + nombre).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_nombre_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_nombre_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + nombre).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_nombre_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_nombre_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (apepat != "") {
        if (document.getElementById(apepat).value.length > 0) {
            $("#" + apepat).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apepat_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apepat_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + apepat).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apepat_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apepat_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (apemat != "") {
        if (document.getElementById(apemat).value.length > 0) {
            $("#" + apemat).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apemat_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apemat_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + apemat).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apemat_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apemat_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (fechanac != "") {
        if (document.getElementById(fechanac).value.length > 0) {
            $("#" + fechanac).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_fechanac_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_fechanac_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + fechanac).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_fechanac_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_fechanac_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (sexo !='') {
        if (document.getElementById(sexo).value != 0) {
            $("#" + sexo).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_sexo_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_sexo_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + sexo).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_sexo_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_sexo_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (telefono != '') {
        if (document.getElementById(telefono).value.length > 0) {
            $("#" + telefono).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_telefono_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_telefono_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + telefono).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_telefono_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_telefono_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (correo != '') {
        if (document.getElementById(correo).value.length > 0) {
            $("#" + correo).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_correo_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_correo_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + correo).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_correo_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_correo_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (estado_civil !='') {
        if (document.getElementById(estado_civil).value!= 0) {
            $("#" + estado_civil).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_estado_civil_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_estado_civil_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + estado_civil).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_estado_civil_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_estado_civil_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (grado_instruccion!='') {
        if (document.getElementById(grado_instruccion).value != 0) {
            $("#" + grado_instruccion).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_grado_instruccion_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_grado_instruccion_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + grado_instruccion).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_grado_instruccion_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_grado_instruccion_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (provincia!='') {
        if (document.getElementById(provincia).value != 0) {
            $("#" + provincia).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_provincia_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_provincia_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + provincia).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_provincia_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_provincia_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (distrito !='') {
        if (document.getElementById(distrito).value!= 0) {
            $("#" + distrito).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_distrito_registrar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_distrito_registrar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + distrito).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_distrito_registrar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_distrito_registrar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    
}

function buscarTutor(){
    let dni=document.querySelector('#id_dni_tutor').value;
    let nombres=document.querySelector('#id_nombre_tutor');
    if (dni.trim()!=''&&dni.trim().length==8) {
        $.ajax({
            url: '../controller/persona/controlador_buscar_tutor.php',
            type: 'POST',
            data: {
                dni:dni
            }
        }).done( function(resp){
            const nom=JSON.parse(resp)
            console.log(nom)
            if (nom['data'].length>0) {
                if(nom['data'][0]['estado']=='A'){
                    nombres.value=nom['data'][0]['nombre'];
                    indicador=true;
                    id_p=nom['data'][0]['id_p'];
                }else{
                    return Swal.fire("Mensaje de Advertencia", "El representante se encuentra de baja, actualice su estado para continuar", "warning");  
                }        
            } else {
                return Swal.fire("Mensaje de Advertencia", "DNI ingresada no existe como representante", "warning");  
            }
        })
    } else {
        return Swal.fire("Mensaje de Advertencia", "Ingrese un DNI válido de 8 caracteres", "warning");  
    }
}

function registrarBeneficiario(){
    if (indicador) {
        const form= new FormData(document.querySelector('#form-registrar-persona-beneficiario'));
        if (form.get('dni_beneficiario').trim()!='' &&form.get('nombre_beneficiario').trim()!=''&&form.get('apepat_beneficiario').trim()!=''&&form.get('apemat_beneficiario').trim()!=''
        &&form.get('fechanac_beneficiario').trim()!=''&&form.get('sexo_beneficiario').trim()!=0&&form.get('telefono_beneficiario').trim()!=''&&form.get('correo_beneficiario').trim()!=''&&form.get('numcertdisc_beneficiario').trim()!=''
        &&form.get('estado_civil_beneficiario').trim()!=0&&form.get('grado_instruccion_beneficiario').trim()!=0&&form.get('provincia_beneficiario').trim()!=0&&form.get('distrito_beneficiario').trim()!=0

        ){
            $.ajax({

                url: '../controller/persona/controlador_registrar_persona.php',
                type: 'POST',
                data: {
                    dni:form.get('dni_beneficiario').trim(),
                    nombre:form.get('nombre_beneficiario').trim(),
                    apepat:form.get('apepat_beneficiario').trim(),
                    apemat:form.get('apemat_beneficiario').trim(),
                    fechanac:form.get('fechanac_beneficiario').trim(),
                    sexo:form.get('sexo_beneficiario').trim(),
                    telefono:form.get('telefono_beneficiario').trim(),
                    correo:form.get('correo_beneficiario').trim(),
                    numcert:form.get('numcertdisc_beneficiario').trim(),
                    tipo:'D',
                    dependiente:id_p,
                    id_esci:form.get('estado_civil_beneficiario').trim(),
                    id_grin:form.get('grado_instruccion_beneficiario').trim(),
                    distrito:form.get('distrito_beneficiario').trim(),
                }
            }).done(function (resp) {
                    if (resp == 1) {
                        //limpiar_modalTipoTramiteRegistrado();
                        return Swal.fire("Mensaje de Confirmacion", "Persona representante registrado correctamente", "success").then((value) => {
                            //$("#modal-registro-tipo-tramite").modal('hide');
                            tbl_persona.ajax.reload();
        
                        });
                    }else if (resp == 2) {
                        return Swal.fire("Mensaje de Advertencia", "Esta persona ya está registrada", "warning");
                    }
            })
            
        }else{
            ValidarInputRegistroBeneficiario('id_dni_registrar_beneficiario','valid_dni_registrar_beneficiario','id_nombre_registrar_beneficiario','valid_nombre_registrar_beneficiario',
                'id_apepat_registrar_beneficiario', 'valid_apepat_registrar_beneficiario','id_apemat_registrar_beneficiarios', 'valid_apemat_registrar_beneficiario','id_fechanac_registrar_beneficiario','valid_fechanac_registrar_beneficiario',
                'id_sexo_registrar_beneficiario','valid_sexo_registrar_beneficiario','id_telefono_registrar_beneficiario','valid_telefono_registrar_beneficiario','id_correo_registrar_beneficiario','valid_correo_registrar_beneficiario','id_numcertdisc_registrar_beneficiario','valid_numcertdisc_registrar_beneficiario', 'id_estado_civil_registrar_beneficiario',
                'valid_estado_civil_registrar_beneficiario', 'id_grado_instruccion_registrar_beneficiario','valid_grado_instruccion_registrar_beneficiario','id_provincia_registrar_beneficiario','valid_provincia_registrar_beneficiario','id_distrito_registrar_beneficiario','valid_distrito_registrar_beneficiario'            
                )
            return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
        }
    } else {
        return Swal.fire("!Mensaje de Advertencia!", "Para registrar un beneficiario, primero busque a su representante", "warning");
    }
    

}
function ValidarInputRegistroBeneficiario(id_dni_registrar_beneficiario,valid_dni_registrar_beneficiario,id_nombre_registrar_beneficiario,valid_nombre_registrar_beneficiario,
    id_apepat_registrar_beneficiario, valid_apepat_registrar_beneficiario,id_apemat_registrar_beneficiarios, valid_apemat_registrar_beneficiario,id_fechanac_registrar_beneficiario,valid_fechanac_registrar_beneficiario,
    id_sexo_registrar_beneficiario,valid_sexo_registrar_beneficiario,id_telefono_registrar_beneficiario,valid_telefono_registrar_beneficiario,id_correo_registrar_beneficiario,valid_correo_registrar_beneficiario,id_numcertdisc_registrar_beneficiario,valid_numcertdisc_registrar_beneficiario, id_estado_civil_registrar_beneficiario,
    valid_estado_civil_registrar_beneficiario, id_grado_instruccion_registrar_beneficiario,valid_grado_instruccion_registrar_beneficiario,id_provincia_registrar_beneficiario,valid_provincia_registrar_beneficiario,id_distrito_registrar_beneficiario,valid_distrito_registrar_beneficiario

    
    ) {
    if (id_dni_registrar_beneficiario != "") {
        if (document.getElementById(id_dni_registrar_beneficiario).value.length > 0) {
            $("#" + id_dni_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_dni_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_dni_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_dni_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_dni_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_dni_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_nombre_registrar_beneficiario != "") {
        if (document.getElementById(id_nombre_registrar_beneficiario).value.length > 0) {
            $("#" + id_nombre_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_nombre_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_nombre_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_nombre_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_nombre_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_nombre_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_apepat_registrar_beneficiario != "") {
        if (document.getElementById(id_apepat_registrar_beneficiario).value.length > 0) {
            $("#" + id_apepat_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apepat_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apepat_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_apepat_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apepat_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apepat_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_apemat_registrar_beneficiarios != "") {
        if (document.getElementById(id_apemat_registrar_beneficiarios).value.length > 0) {
            $("#" + id_apemat_registrar_beneficiarios).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apemat_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apemat_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_apemat_registrar_beneficiarios).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apemat_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apemat_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_fechanac_registrar_beneficiario != "") {
        if (document.getElementById(id_fechanac_registrar_beneficiario).value.length > 0) {
            $("#" + id_fechanac_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_fechanac_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_fechanac_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_fechanac_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_fechanac_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_fechanac_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_sexo_registrar_beneficiario !='') {
        if (document.getElementById(id_sexo_registrar_beneficiario).value != 0) {
            $("#" + id_sexo_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_sexo_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_sexo_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_sexo_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_sexo_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_sexo_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_telefono_registrar_beneficiario != '') {
        if (document.getElementById(id_telefono_registrar_beneficiario).value.length > 0) {
            $("#" + id_telefono_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_telefono_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_telefono_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_telefono_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_telefono_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_telefono_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_correo_registrar_beneficiario != '') {
        if (document.getElementById(id_correo_registrar_beneficiario).value.length > 0) {
            $("#" + id_correo_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_correo_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_correo_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_correo_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_correo_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_correo_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_numcertdisc_registrar_beneficiario != '') {
        if (document.getElementById(id_numcertdisc_registrar_beneficiario).value.length > 0) {
            $("#" + id_numcertdisc_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_numcertdisc_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_numcertdisc_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_numcertdisc_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_numcertdisc_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_numcertdisc_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_estado_civil_registrar_beneficiario !='') {
        if (document.getElementById(id_estado_civil_registrar_beneficiario).value!= 0) {
            $("#" + id_estado_civil_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_estado_civil_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_estado_civil_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_estado_civil_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_estado_civil_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_estado_civil_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_grado_instruccion_registrar_beneficiario!='') {
        if (document.getElementById(id_grado_instruccion_registrar_beneficiario).value != 0) {
            $("#" + id_grado_instruccion_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_grado_instruccion_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_grado_instruccion_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_grado_instruccion_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_grado_instruccion_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_grado_instruccion_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_provincia_registrar_beneficiario!='') {
        if (document.getElementById(id_provincia_registrar_beneficiario).value != 0) {
            $("#" + id_provincia_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_provincia_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_provincia_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_provincia_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_provincia_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_provincia_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_distrito_registrar_beneficiario !='') {
        if (document.getElementById(id_distrito_registrar_beneficiario).value!= 0) {
            $("#" + id_distrito_registrar_beneficiario).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_distrito_registrar_beneficiario).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_distrito_registrar_beneficiario).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_distrito_registrar_beneficiario).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_distrito_registrar_beneficiario).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_distrito_registrar_beneficiario).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    
}

var id_pers=0;
var id_bene=0;
$('#tbl-persona').on('click', '.editar',async function () {
    var data = tbl_persona.row($(this).parents('tr')).data();
    if (tbl_persona.row(this).child.isShown()) {
        var data = tbl_persona.row(this).data();
    }
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    if (data["tipo_pe"]=='R') {
        $("#modal-modificar-representate").modal({ backdrop: 'static', keyboard: false });
        $("#modal-modificar-representate").modal('show');
        document.getElementById('id_dni_modificar').value = data["dni_pe"];
        document.getElementById('id_nombre_modificar').value = data["nombre_pe"];
        document.getElementById('id_apepat_modificar').value = data["apepat_pe"];
        document.getElementById('id_apemat_modificar').value = data["apemat_pe"];
        document.getElementById('id_fechanac_modificar').value = data["fecha_pe"];
        $('#id_sexo_modificar').select2().val(data["sexo_pe"]).trigger('change.select2');
        document.getElementById('id_telefono_modificar').value = data["telefono_pe"];
        document.getElementById('id_correo_modificar').value = data["correo_pe"];
        $('#id_estado_civil_modificar').select2().val(data["id_esci"]).trigger('change.select2');
        $('#id_grado_instruccion_modificar').select2().val(data["id_grin"]).trigger('change.select2');
        $('#id_provincia_modificar').select2().val(data["provincia_ubig"]).trigger('change.select2');
        await new Promise(resolve =>{
            setTimeout(resolve,1000)
        })
        $('#id_distrito_modificar').select2().val(data["distrito_ubig"]).trigger('change.select2');
        id_pers=data["id_pe"];
        indicador=true;
        console.log(id_pers)
    } else {
        $("#modal-modificar-beneficiario").modal({ backdrop: 'static', keyboard: false });
        $("#modal-modificar-beneficiario").modal('show');
        document.getElementById('id_dni_modificar_beneficiario').value = data["dni_pe"];
        document.getElementById('id_nombre_modificar_beneficiario').value = data["nombre_pe"];
        document.getElementById('id_apepat_modificar_beneficiario').value = data["apepat_pe"];
        document.getElementById('id_apemat_modificar_beneficiario').value = data["apemat_pe"];
        document.getElementById('id_fechanac_modificar_beneficiario').value = data["fecha_pe"];
        $('#id_sexo_modificar_beneficiario').select2().val(data["sexo_pe"]).trigger('change.select2');
        document.getElementById('id_telefono_modificar_beneficiario').value = data["telefono_pe"];
        document.getElementById('id_correo_modificar_beneficiario').value = data["correo_pe"];
        document.getElementById('id_numcertdisc_modificar_beneficiario').value = data["numcertdisc"];  
        $('#id_estado_civil_modificar_beneficiario').select2().val(data["id_esci"]).trigger('change.select2');
        $('#id_grado_instruccion_modificar_beneficiario').select2().val(data["id_grin"]).trigger('change.select2');
        $('#id_provincia_modificar_beneficiario').select2().val(data["provincia_ubig"]).trigger('change.select2');
        await new Promise(resolve =>{
            setTimeout(resolve,1000)
        })
        $('#id_distrito_modificar_beneficiario').select2().val(data["distrito_ubig"]).trigger('change.select2');

        id_bene=data["id_pe"];
        id_pers=data["dependiente_pe"]
        indicador=true;
    }
    

})

function listarDistritoXprovinciaTutorModificar(){
    var valSelect=document.querySelector('#id_provincia_modificar').value;
    if (valSelect!=0) {
        let slctDistrito = document.querySelector("#id_distrito_modificar");
        $.ajax({
            url: '../controller/ubigeo/controlador_listar_distritoXprovincia.php',
            type: 'POST',
            data: {
                provincia:valSelect,
            }
        }).done(function (response) {
            const distrito = JSON.parse(response);
            slctDistrito.innerHTML = '';
            slctDistrito.innerHTML = '<option value="0">SELECCIONE</option>';
            for (let i = 0; i < distrito["data"].length; i++) {
                slctDistrito.innerHTML+=`
                    <option value="${distrito['data'][i]["distrito"]}">${distrito['data'][i]["distrito"]}</option>
                `;
            }
        })
    }
    

}

function modificarRepresentante(){
    if (indicador) {
        const form= new FormData(document.querySelector('#form-modificar-representante'));

        if (form.get('dni').trim()!='' &&form.get('nombre').trim()!=''&&form.get('apepat').trim()!=''&&form.get('apemat').trim()!=''
        &&form.get('fechanac').trim()!=''&&form.get('sexo').trim()!=0&&form.get('telefono').trim()!=''&&form.get('correo').trim()!=''
        &&form.get('estado_civil').trim()!=0&&form.get('grado_instruccion').trim()!=0&&form.get('provincia').trim()!=0&&form.get('distrito').trim()!=0&&form.get('estado')!='') {
        console.log(form.get('fechanac').trim())
            $.ajax({
                url: '../controller/persona/controlador_modificar_persona.php',
                type: 'POST',
                data: {
                    id:id_pers,
                    dni:form.get('dni').trim(),
                    nombre:form.get('nombre').trim(),
                    apepat:form.get('apepat').trim(),
                    apemat:form.get('apemat').trim(),
                    fechanac:form.get('fechanac').trim(),
                    sexo:form.get('sexo').trim(),
                    telefono:form.get('telefono').trim(),
                    correo:form.get('correo').trim(),
                    numcert:null,
                    tipo:'R',
                    estado:form.get('estado').trim(),
                    dependiente:0,
                    id_esci:form.get('estado_civil').trim(),
                    id_grin:form.get('grado_instruccion').trim(),
                    distrito:form.get('distrito').trim(),
                }
            }).done(function (resp) {
                    if (resp == 1) {
                        //limpiar_modalTipoTramiteRegistrado();
                        return Swal.fire("Mensaje de Confirmacion", "Persona representante modificada correctamente", "success").then((value) => {
                            //$("#modal-registro-tipo-tramite").modal('hide');
                            tbl_persona.ajax.reload();
        
                        });
                    }else if (resp == 2) {
                        return Swal.fire("Mensaje de Advertencia", "Esta persona ya está registrada", "warning");
                    }
            })
        }else {
            ValidarInputRegistroTutor('id_dni_modificar', 'valid_dni_modificar','id_nombre_modificar','valid_nombre_modificar',
                'id_apepat_modificar', 'valid_apepat_modificar','id_apemat_modificar', 'valid_apemat_modificar','id_fechanac_modificar','valid_fechanac_modificar',
                'id_sexo_modificar','valid_sexo_modificar','id_telefono_modificar','valid_telefono_modificar','id_correo_modificar','valid_correo_modificar','id_estado_civil_modificar',
                'valid_estado_civil_modificar', 'id_grado_instruccion_modificar','valid_grado_instruccion_modificar','id_provincia_modificar','valid_provincia_modificar','id_distrito_modificar','valid_distrito_modificar',
                'id_estado_modificar','valid_estado_modificar')
            return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
        }
    } else {
        return Swal.fire("!Mensaje de Advertencia!", "Para registrar un beneficiario, primero busque a su representante", "warning");
    }
}

function ValidarInputRegistroTutor(id_dni_modificar, valid_dni_modificar,id_nombre_modificar,valid_nombre_modificar,
    id_apepat_modificar, valid_apepat_modificar,id_apemat_modificar, valid_apemat_modificar,id_fechanac_modificar,valid_fechanac_modificar,
    id_sexo_modificar,valid_sexo_modificar,id_telefono_modificar,valid_telefono_modificar,id_correo_modificar,valid_correo_modificar,id_estado_civil_modificar,
    valid_estado_civil_modificar, id_grado_instruccion_modificar,valid_grado_instruccion_modificar,id_provincia_modificar,valid_provincia_modificar,id_distrito_modificar,valid_distrito_modificar,
    id_estado_modificar,valid_estado_modificar
    ) {
    if (id_dni_modificar != "") {
        if (document.getElementById(id_dni_modificar).value.length > 0) {
            $("#" + id_dni_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_dni_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_dni_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_dni_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_dni_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_dni_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_nombre_modificar != "") {
        if (document.getElementById(id_nombre_modificar).value.length > 0) {
            $("#" + id_nombre_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_nombre_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_nombre_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_nombre_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_nombre_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_nombre_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_apepat_modificar != "") {
        if (document.getElementById(id_apepat_modificar).value.length > 0) {
            $("#" + id_apepat_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apepat_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apepat_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_apepat_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apepat_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apepat_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_apemat_modificar != "") {
        if (document.getElementById(id_apemat_modificar).value.length > 0) {
            $("#" + id_apemat_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_apemat_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_apemat_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_apemat_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_apemat_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_apemat_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_fechanac_modificar != "") {
        if (document.getElementById(id_fechanac_modificar).value.length > 0) {
            $("#" + id_fechanac_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_fechanac_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_fechanac_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_fechanac_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_fechanac_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_fechanac_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_sexo_modificar !='') {
        if (document.getElementById(id_sexo_modificar).value != 0) {
            $("#" + id_sexo_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_sexo_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_sexo_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_sexo_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_sexo_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_sexo_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_telefono_modificar != '') {
        if (document.getElementById(id_telefono_modificar).value.length > 0) {
            $("#" + id_telefono_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_telefono_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_telefono_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_telefono_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_telefono_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_telefono_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_correo_modificar != '') {
        if (document.getElementById(id_correo_modificar).value.length > 0) {
            $("#" + id_correo_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_correo_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_correo_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_correo_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_correo_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_correo_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_estado_civil_modificar !='') {
        if (document.getElementById(id_estado_civil_modificar).value!= 0) {
            $("#" + id_estado_civil_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_estado_civil_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_estado_civil_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_estado_civil_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_estado_civil_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_estado_civil_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_grado_instruccion_modificar!='') {
        if (document.getElementById(id_grado_instruccion_modificar).value != 0) {
            $("#" + id_grado_instruccion_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_grado_instruccion_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_grado_instruccion_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_grado_instruccion_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_grado_instruccion_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_grado_instruccion_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_provincia_modificar!='') {
        if (document.getElementById(id_provincia_modificar).value != 0) {
            $("#" + id_provincia_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_provincia_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_provincia_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_provincia_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_provincia_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_provincia_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_distrito_modificar !='') {
        if (document.getElementById(id_distrito_modificar).value!= 0) {
            $("#" + id_distrito_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_distrito_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_distrito_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_distrito_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_distrito_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_distrito_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    if (id_estado_modificar !='') {
        if (document.getElementById(id_estado_modificar).value!= 0) {
            $("#" + id_estado_modificar).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_estado_modificar).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(valid_estado_modificar).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + id_estado_modificar).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_estado_modificar).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_estado_modificar).innerHTML = '<b>COMPLETE EL CAMPO</b>';
        }
    }
    
}

