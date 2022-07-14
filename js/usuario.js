
$(document).ready(function(){
    $('.js-example-basic-single').select2();
    listado_usu_simple();
})

function iniciar_Sesion() {
    let usu = document.getElementById("txtUsu").value;
    let pass = document.getElementById("txtPass").value;
    if (usu.length == 0 || pass.length == 0) {
        ValidarInputUsuario("txtUsu", "txtPass");/// para que se me muesree lo rojo
        return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '!LLENE LOS CAMPOS DE LA SESSION!',

        });
    }

    $.ajax({

        url: 'controller/usuario/iniciar_sesion.php',
        type: 'POST',
        data: {
            u: usu,
            p: pass,
        }

    }).done(function (resp) {
        let data = JSON.parse(resp);// Lo convierto a un objketo el json_encode

        if (data.length > 0) {
            if (data[0]["usua_estado"] == 'INACTIVO') {

                return Swal.fire('OOPSS...', 'Lo sentimos el usuario <br>' + data[0]["nombre"] + "<b/> se encuentra " + data[0]["usua_estado"] + ", comuniquese con el administrador", 'warning');

            }
            $.ajax({
                
                url: 'controller/usuario/crear_sesion.php',
                type: 'POST',
                data: {
                    id_usu: data[0][0],
                    dni: data[0][1],
                    apepatusu: data[0]['apelpat'],
                    apematusu: data[0]['apelmat'],
                    nombre_usu: data[0]['nombreusu'],
                    usua_clave: data[0]['usua_clave'],
                    usuario: data[0]['nombre'],
                    //rol: data[0][6]
                },

            }).done(function (r) {
                let timerInterval
                Swal.fire({
                    title: 'BIENVENIDO AL SISTEMA',
                    html: 'Sera redireccionado en <b></b> milliseconds.',
                    timer: 800,
                    heightAuto: false,// para que el login no se mueva hacia arriba
                    timerProgressBar: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                })

            })



        } else {
            console.log(resp)
            Swal.fire('INCORRECTO', 'Usuaio o Contraseña incorrectos', 'error');
        }


    })
}
function ValidarInputUsuario(usu, pass) {
    if (usu != "") {
        Boolean(document.getElementById(usu).value.length > 0) ? $("#" + usu).removeClass("is-invalid").addClass("is-valid") : $("#" + usu).removeClass("is-valid").addClass("is-invalid");
    }
    if (pass != "") {
        Boolean(document.getElementById(pass).value.length > 0) ? $("#" + pass).removeClass("is-invalid").addClass("is-valid") : $("#" + pass).removeClass("is-valid").addClass("is-invalid");
    }
}
var tbl_usuario_simple;
function listado_usu_simple() {
    tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/usuario/controlador_listar_usu.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "dniusu" },
            { "data": "apepatusu" },
            { "data": "apematusu" },
            { "data": "usua_nombre" },
            { "data": "correousu" },
            //{ "data": "usua_estado" },
            /*{
                "data": "usua_nivel",
                render: function (data, type, row) {

                    if (data == "ADMIN") {
                        return "<span class='badge bg-secondary'>" + data + "</span>";
                    } if (data == "OPERADOR") {
                        return "<span class='badge bg-info'>" + data + "</span>";
                    }
                    else {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    }
                }

            },*/
            {
                "data": "usua_estado",
                render: function (data, type, row) {

                    if (data == "A") {
                        return "<span class='badge bg-success'>Activo</span>";
                    } else {
                        return '<span class="badge bg-danger">Inactivo</span>';
                    }
                }
            },

            {
                "data": "usua_estado",
                render: function (data, type, row) {
                    if (data == 'A') {
                        return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;" +
                            "<button class = 'btn btn-success btn-sm' disabled><i class = 'fa fa-check-circle'></i></button>&nbsp;" +
                            "<button class = 'desactivar btn btn-danger btn-sm'><i class = 'fa fa-ban'></i></button>";
                    } else {
                        return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;" +
                            "<button class = 'activar btn btn-success btn-sm' ><i class = 'fa fa-check-circle'></i></button>&nbsp;" +
                            "<button class = 'btn btn-danger btn-sm' disabled><i class = 'fa fa-ban'></i></button>";
                    }
                }
            }

        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_usuario_simple.on('draw.td', function () {
        var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
        tbl_usuario_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}

//CAMBIAR ESTADO---------------------------------------------------------------------------------
$('#tabla_usuario_simple').on('click', '.activar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data(); //En tamaño escritorio

    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usar el responsive de Data Table
    Swal.fire({
        title: 'Estas seguro de cambiar el estado a ACTIVO?',
        text: "Una vez realizado esto el usuario tendrá acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus(data["idusu"], "A");
        }
    })
})


$('#tabla_usuario_simple').on('click', '.desactivar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data(); //En tamaño escritorio

    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usar el responsive de Data Table
    Swal.fire({
        title: 'Estas seguro de cambiar el estado a INACTIVO? ',
        text: "Una vez realizado esto el usuario NO tendrá acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus(data["idusu"], "I");
        }
    })
})

function Modificar_Estatus(id, estatus) {
    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario_estatus.php',
        type: 'POST',
        data: {
            id: id,
            estatus: estatus
        }

    }).done(function (resp) {
        // alert(resp);
        if (resp > 0) {

            Swal.fire("Mensaje de Confirmacion", "Estado actualizado", "success").
                then((value) => {
                    tbl_usuario_simple.ajax.reload();
                });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo cambiar el estado", "error");
        }
    });
}
//---------------------------------------------------------------------------------------------------------




function abrirModalRegistroUsuario() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_usu").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_usu").modal('show');//abirir modal
    document.getElementById("valid_nivel").innerHTML = '';


}
function registrar_usuario() {

    let dni = document.getElementById("txt_dni").value;
    let nombre = document.getElementById("txt_nombre").value;
    let apellido_p = document.getElementById("txt_aPaterno").value;
    let apellido_m = document.getElementById("txt_aMaterno").value;
    let contraseña = document.getElementById("txt_contraseña").value;
    let correo = document.getElementById("txt_correo").value;
    //let nivel = document.getElementById("select_nivel").value;

    //document.getElementById("valid_dni").value;
/*
    if (nivel.length == 0) {
        document.getElementById("valid_nivel").innerHTML = '<font size=2 color="red"><b>SELECCIONE UN NIVEL PARA CONTINUAR</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>El campo nivel, no se ecuentra seleccionado, por favor seleccione un nivel</b>", "warning");
    }
    document.getElementById("valid_nivel").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';
*/
    if (dni.length == 0 || dni.length < 8 || apellido_p.length == 0 || apellido_m.length == 0 || contraseña.length == 0 || contraseña.length < 8 || nombre.length == 0 || correo.length==0) {
        ValidarInputRegisUsuario("txt_dni", "txt_nombre", "txt_aPaterno", "txt_aMaterno", "txt_contraseña",
            "valid_dni", "valid_nombre", "valid_apepat", "valid_apemat", "valid_contrasena",'txt_correo','valid_correo');/// para que se me muesree lo rojo
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");

    }


    $.ajax({

        url: '../controller/usuario/controlador_registrar_usuario.php',
        type: 'POST',
        data: {
            dni: dni,
            nombre: nombre,
            apepat: apellido_p,
            apemat: apellido_m,
            correo:correo,
            contra: contraseña,

        }
    }).done(function (resp) {
        //alert(resp)
        if (resp > 0) {
            if (resp == 1) {
                limpiar_modalUsuarioRegistrado();
                return Swal.fire("Mensaje de Confirmacion", "Nuevo Usuario Registrado", "success").then((value) => {
                    $("#modal_registro_usu").modal('hide');
                    tbl_usuario_simple.ajax.reload();

                });
            }else if (resp == 2) {
                return Swal.fire("Mensaje de Advertencia", "Este usuario ya esta Registrado", "warning");

            } else {
                return Swal.fire("Mensaje de Advertencia", "El correo electrónico ya está registrado, ingrese otro.", "warning");

            }

        } else {
            console.log(resp)
            return Swal.fire("Mensaje de Advertencia", "No se pudor registrar el Usuario ", "error");

        }
    })

}
function ValidarInputRegisUsuario(dni, nombre, apepat, apemat, pass, val_dni, val_nombre, val_apepat, val_apemat, val_pass,txt_correo,valid_correo) {
    if (dni != "") {
        if (document.getElementById(dni).value.length > 0 && document.getElementById(dni).value.length == 8) {
            $("#" + dni).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_dni).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_dni).innerHTML = '<b>DNI CORRECTO<b>';
        }
        else {
            $("#" + dni).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_dni).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_dni).innerHTML = '<b>COMPLETE EL CAMPO DNI"DEBE CONTENER 8 CARACTERRES"</b>';
        }
    }
    if (nombre != "") {
        if (document.getElementById(nombre).value.length > 0) {
            $("#" + nombre).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_nombre).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_nombre).innerHTML = '<b>NOMBRE CORRECTO</b>';
        }
        else {
            $("#" + nombre).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_nombre).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_nombre).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    if (apepat != "") {
        if (document.getElementById(apepat).value.length > 0) {
            $("#" + apepat).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_apepat).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(val_apepat).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + apepat).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_apepat).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_apepat).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    if (apemat != "") {
        if (document.getElementById(apemat).value.length > 0) {
            $("#" + apemat).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_apemat).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(val_apemat).innerHTML = '<b>CORRECTO</b>';
        }
        else {
            $("#" + apemat).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_apemat).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_apemat).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    if (pass != "") {
        if (document.getElementById(pass).value.length > 0 && document.getElementById(pass).value.length >= 8) {
            $("#" + pass).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_pass).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(val_pass).innerHTML = '<b>CORRECTO</b>';
        }
        else {
            $("#" + pass).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_pass).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_pass).innerHTML = '<b>LA CONTRASEÑA DEBE TENER MAS DE 8 CARACTERES</b>';
        }
    }
    if (txt_correo != "") {
        if (document.getElementById(txt_correo).value.length > 0 && document.getElementById(pass).value.length >= 8) {
            $("#" + txt_correo).removeClass("is-invalid").addClass("is-valid");
            $("#" + valid_correo).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(valid_correo).innerHTML = '<b>CORRECTO</b>';
        }
        else {
            $("#" + txt_correo).removeClass("is-valid").addClass("is-invalid");
            $("#" + valid_correo).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(valid_correo).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
}
function limpiar_modalUsuarioRegistrado() {
    document.getElementById("txt_dni").value = "";
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_aPaterno").value = "";
    document.getElementById("txt_aMaterno").value = "";
    document.getElementById("txt_contraseña").value = "";
    document.getElementById("txt_correo").value = "";
    document.getElementById("valid_nivel").innerHTML = '';
    $('#select_nivel').select2().val("").trigger('change.select2');

}
//////////////////////////////////////////////EDITAR
var idusuc;
$('#tabla_usuario_simple').on('click', '.editar', function () {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_usuario").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_editar_usuario").modal('show');
    document.getElementById('txt_idUsu_editar').value = data["idusu"];
    document.getElementById('txt_dni_editar').value = data["dniusu"];
    document.getElementById('txt_nombre_editar').value = data["usua_nombre"];
    document.getElementById('txt_aPaterno_editar').value = data["apepatusu"];
    document.getElementById('txt_aMaterno_editar').value = data["apematusu"];
    document.getElementById('txt_correo_editar').value = data["correousu"];
    document.getElementById('txt_contra_editar').value = data["usua_clave"];
    //document.getElementById('txt_contra_repetir').value = data["usu_email"];
    $('#select_nivel_editar').select2().val(data["usua_nivel"]).trigger('change.select2');
    $('#select_estado_editar').select2().val(data["usua_estado"]).trigger('change.select2');
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    idusuc = data["idusu"];

})
function modificar_usuario() {
    //let idusu = document.getElementById('txt_idUsu_editar').value;
    let dni = document.getElementById('txt_dni_editar').value;
    let nombre = document.getElementById('txt_nombre_editar').value;
    let apat = document.getElementById('txt_aPaterno_editar').value;
    let amat = document.getElementById('txt_aMaterno_editar').value;
    let contra = document.getElementById('txt_contra_editar').value;
    let correo = document.getElementById('txt_correo_editar').value;
    //let nivel = document.getElementById('select_nivel_editar').value;
    //let estado = document.getElementById('select_estado_editar').value;
    //return alert(contra);

    if (dni.length == 0 || dni.length < 8 || nombre.length == 0 || apat.length == 0 || amat.length == 0 || contra.length == 0 || correo.length==0) {
        ValidarInputRegisUsuario("txt_dni_editar", "txt_nombre_editar", "txt_aPaterno_editar", "txt_aMaterno_editar", "txt_contra_editar",
            "valid_dni_editar", "valid_nombre_editar", "valid_apepat_editar", "valid_apemat_editar", "valid_contra_editar",'txt_correo_editar','valid_correo_editar');/// para que se me muesree lo rojo

        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }
    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario.php',
        type: 'POST',
        data: {
            id: idusuc,
            dni: dni,
            nombre: nombre,
            apat: apat,
            amat: amat,
            correo:correo,
            contra: contra,
            //nivel: nivel,
            //estado: estado
        }
    }).done(function (resp) {
        //alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                return Swal.fire("Mensaje de Confirmacion", "Usuario editado con éxito", "success").then((value) => {
                    $("#modal_editar_usuario").modal('hide');
                    tbl_usuario_simple.ajax.reload();

                });
            }else if (resp == 2) {
                return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");
            } else {
                return Swal.fire("Mensaje de Advertencia", "Este correo electrónico ya esta Registrado", "warning");
            }

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo modificar el Usuario ", "error");

        }
    })
}
////////////////////////////////MODIFICAR PASSWORD
function abrirmodal_modificarcontra() {
    /* var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
     if (tbl_usuario_simple.row(this).child.isShown()) {
         var data = tbl_usuario_simple.row(this).data();
     }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable*/

    $("#modal_editar_contra").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_editar_contra").modal('show');
    document.getElementById('idUsuarioContra').value = idusuc;
    //document.getElementById('txt_contra_editar').value = data["usua_clave"];

}
function modificar_contra_usuario() {
    let idusu = document.getElementById('idUsuarioContra').value;
    let contran = document.getElementById('txt_contra_nueva').value;
    let contrar = document.getElementById('txt_contra_repetir').value;
    if (contran.length == 0 || contrar.length == 0) {
        inputvalidarcontra("", "txt_contra_nueva", "txt_contra_repetir");
        return Swal.fire("Mensaje de Advertencia", "llene todos los campos", "warning");
    }
    if (contran != contrar) {
        return Swal.fire("Mensaje de Advertencia", "Las contraseñas no coinciden", "warning");
    }
    $.ajax({
        url: '../controller/usuario/controlador_modificar_contra_usuario.php',
        type: 'POST',
        data: {
            idusu: idusu,
            contran: contran
        }
    }).done(function (resp) {
        //alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                return Swal.fire("Mensaje de Confirmacion", "Contraseña editada con éxito", "success").then((value) => {
                    $("#modal_editar_contra").modal('hide');
                    $("#modal_editar_usuario").modal('hide');
                    tbl_usuario_simple.ajax.reload();

                });
            }
            return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo modificar la contraseña ", "error");

        }
    })


}
function inputvalidarcontra($contrac, $contran, $contrar, resp) {
    if ($contrac != "") {
        if (resp != "" && resp.length == 0) {
            $("#" + $contrac).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contrac).removeClass("is-valid").addClass("is-invalid");
        }
    }
    if ($contran != "") {
        if (document.getElementById($contran).value.length > 0) {
            $("#" + $contran).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contran).removeClass("is-valid").addClass("is-invalid");
        }
    }
    if ($contrar != "") {
        if (document.getElementById($contrar).value.length > 0) {
            $("#" + $contrar).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contrar).removeClass("is-valid").addClass("is-invalid");
        }
    }
}
//////////////////////////////////-modal para editar usuario personal
function abrir_modal_edipersonal() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_contraPersonal").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_editar_contraPersonal").modal('show');

}
function modificar_contra_usuariopersonal() {
    let id_usu = document.getElementById('id_usuap_edit').value;
    let dni_usu = document.getElementById('id_dni_validar').value;
    let contrac = document.getElementById('txt_contra_actual').value;
    let contran = document.getElementById('txt_contra_nueva_edit').value;
    let contrar = document.getElementById('txt_contra_repetir_edit').value;
    if (contrac.length == 0 || contrac.length == 0 || contran.length == 0) {
        inputvalidarcontra("txt_contra_actual", "txt_contra_nueva_edit", "txt_contra_repetir_edit", "");
        return Swal.fire("Mensaje de Advertencia", "Llene todos los campos", "warning");
    }
    $.ajax({

        url: '../controller/usuario/iniciar_sesion.php',
        type: 'POST',
        data: {
            u: dni_usu,
            p: contrac
        }

    }).done(function (resp) {
        //alert(resp);
        if (resp == 0) {
            inputvalidarcontra("txt_contra_actual", "txt_contra_nueva_edit", "txt_contra_repetir_edit", resp);
            return Swal.fire("Mensaje de Advertencia", "La contraseña ingreseda no coincide con la actual", "warning");
        }
        else {
            $.ajax({
                url: '../controller/usuario/controlador_modificar_contra_usuario.php',
                type: 'POST',
                data: {
                    idusu: id_usu,
                    contran: contran
                }
            }).done(function (resp) {
                //alert(resp);
                if (resp > 0) {
                    if (resp == 1) {

                        return Swal.fire("Mensaje de Confirmacion", "Contraseña editada con éxito", "success").then((value) => {
                            $("#modal_editar_contraPersonal").modal('hide');
                            //location.reload();

                        });
                    }
                    return Swal.fire("Mensaje de Advertencia", "Surgio", "warning");

                } else {
                    return Swal.fire("Mensaje de Advertencia", "No se pudo modificar la contraseña ", "error");

                }
            })
        }
    })

}