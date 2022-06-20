$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listarPersona();
    listarProvincia();
    listarGradoInstitucion();
    listarEstadoCivil();
})



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
            { "data": "denominacion_esci" },
            { "data": "denominacion_grin" },
            { "data": "denominacion_ubig" },

            { "defaultContent": "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>" },
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
    $.ajax({
        url: '../controller/ubigeo/controlador_listar_provincia_ubigeo.php',
        type: 'GET',
    }).done(function (response) {
        const provincia = JSON.parse(response);
        slctProvincia.innerHTML = '';
        slctProvincia.innerHTML = '<option value="0">SELECCIONE UNA PROVINCIA</option>';
        for (let i = 0; i < provincia["data"].length; i++) {
            
            slctProvincia.innerHTML += `
                            <option value="${provincia['data'][i]["provincia"]}">${provincia['data'][i]["provincia"]}</option>
                                    `;
        }

    })
}

function listarEstadoCivil(){
    let slctEstadoCivil = document.querySelector("#id_estado_civil_registrar");
    $.ajax({
        url: '../controller/estado_civil/controlador_listar_estado_civil.php',
        type: 'GET',
    }).done(function (response) {
        const estadoCivil = JSON.parse(response);
        slctEstadoCivil.innerHTML = '';
        slctEstadoCivil.innerHTML = '<option value="0">SELECCIONE UNA ESTADO CIVIL</option>';
        for (let i = 0; i < estadoCivil["data"].length; i++) {
            
            slctEstadoCivil.innerHTML += `
                            <option value="${estadoCivil['data'][i]["id_ec"]}">${estadoCivil['data'][i]["denominacion_ec"]}</option>
                                    `;
        }
    })

}

function listarGradoInstitucion(){
    let slctGradoInstitucion = document.querySelector("#id_grado_instruccion_registrar");
    $.ajax({
        url: '../controller/grado_instruccion/controlador_listar_grado_instruccion.php',
        type: 'GET',
    }).done(function (response) {
        console.log(JSON.parse(response))
        const gradoInstitucion = JSON.parse(response);
        slctGradoInstitucion.innerHTML = '';
        slctGradoInstitucion.innerHTML = '<option value="0">SELECCIONE UN GRADO DE INSTRUCCIÓN</option>';
        for (let i = 0; i < gradoInstitucion["data"].length; i++) {
            
            slctGradoInstitucion.innerHTML += `
                            <option value="${gradoInstitucion['data'][i]["id_gi"]}">${gradoInstitucion['data'][i]["denominacion_gi"]}</option>
                                    `;
        }
    })

}