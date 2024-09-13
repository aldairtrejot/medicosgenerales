var notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    dismissible: true, // Permite que las notificaciones sean cerrables
    duration: 3000, // Duración predeterminada de las notificaciones en milisegundos (opcional)
});


var id_postulantes = document.getElementById('id_postulantes').value;

$(document).ready(function () {
    getData();
});


function getData() {
    let post_nombre = document.getElementById("post_nombre");
    let post_curp = document.getElementById("post_curp");
    let post_correo = document.getElementById("post_correo");
    let post_telefono = document.getElementById("post_telefono");
    let post_cedula = document.getElementById("post_cedula");
    let post_carrera = document.getElementById("post_carrera");
    let post_nacimiento = document.getElementById("post_nacimiento");
    let post_entidad_clue = document.getElementById("post_entidad_clue");
    let post_clue = document.getElementById("post_clue");
    let post_clue_nombre = document.getElementById("post_clue_nombre");

    $.post("../../../../App/Controllers/Central/PostulanteC/getDataC.php", {
        id_postulantes: id_postulantes
    },
        function (data) {
            let jsonData = JSON.parse(data);
            let result = jsonData.result;

            post_nombre.textContent = result[0];
            post_curp.textContent = result[1];
            post_correo.textContent = result[2];
            post_telefono.textContent = result[3];
            post_cedula.textContent = result[4];
            post_carrera.textContent = result[5];
            post_nacimiento.textContent = result[6];
            post_entidad_clue.textContent = result[9];
            post_clue.textContent = result[7];
            post_clue_nombre.textContent = result[8];
        }
    );
}


function modalAgregarEditar() {
    $.post("../../../../App/Controllers/Central/PostulanteC/GetDataUpdateC.php", {
        id_postulantes: id_postulantes
    },
        function (data) {

            let jsonData = JSON.parse(data);
            let result = jsonData.result;


            $("#postulante").val(result.postulante);
            $("#desc_cedula_sep").val(result.desc_cedula_sep);
            $("#curp").val(result.curp);
            $("#email").val(result.email);
            $("#cedula_sep").val(result.cedula_sep);
            $("#telefono").val(result.telefono);
            $("#nombre").val(result.nombre);
            $("#primer_apellido").val(result.primer_apellido);
            $("#segundo_apellido").val(result.segundo_apellido);
            $("#id_clues_result").val(result.id_clues);

            $("#id_cat_entidad").val(jsonData.entidad);
            $("#nombre_unidad").val(jsonData.nombre);


            $('#id_cat_entidad_nacimiento').html(jsonData.estados);
            $('#id_clues').html(jsonData.clue);

            $('#id_cat_entidad_nacimiento').selectpicker('refresh');
            $('#id_clues').selectpicker('refresh');
            $('.selectpicker').selectpicker();
        }
    );
    $("#agregar_editar_modal").modal("show");
}

function ocultarAgregarEditar() {
    $("#agregar_editar_modal").modal("hide");
}


document.addEventListener('DOMContentLoaded', function () {
    let selectElement = document.getElementById('id_clues');
    if (selectElement) {
        selectElement.addEventListener('change', function (event) {
            let selectedValue = event.target.value;

            if (selectedValue != '') {
                $.post("../../../../App/Controllers/Central/PostulanteC/getDataCluesC.php", {
                    selectedValue: selectedValue
                },
                    function (data) {
                        let jsonData = JSON.parse(data);
                        let result = jsonData.result;

                        $("#id_cat_entidad").val(result[1]);
                        $("#nombre_unidad").val(result[0]);
                    }
                );
            } else {
                $("#id_cat_entidad").val('');
                $("#nombre_unidad").val('');
            }
        });
    }
});


function actualizarInformacionPos() {
    $.post("../../../../App/Controllers/Central/PostulanteC/updateDataC.php", {
        id_postulantes: id_postulantes,
        desc_cedula_sep: $("#desc_cedula_sep").val(),
        cedula_sep: $("#cedula_sep").val(),
        nombre: $("#nombre").val(),
        primer_apellido: $("#primer_apellido").val(),
        segundo_apellido: $("#segundo_apellido").val(),
        curp: $("#curp").val(),
        email: $("#email").val(),
        telefono: $("#telefono").val(),
        id_cat_entidad_nacimiento: $("#id_cat_entidad_nacimiento").val(),
        id_clues: $("#id_clues").val(),
    },
        function (data) {
            if (data) {
                notyf.success('Tus cambios han sido guardados exitosamente');
            } else {
                notyf.error('"Se produjo un problema inesperado');
            }
            ocultarAgregarEditar();
            getData();
        }
    );
}



function validarDataPost() {
    let desc_cedula_sep = document.getElementById("desc_cedula_sep").value;
    let cedula_sep = document.getElementById("cedula_sep").value;
    let nombre = document.getElementById("nombre").value;
    let primer_apellido = document.getElementById("primer_apellido").value;
    let segundo_apellido = document.getElementById("segundo_apellido").value;
    let curp = document.getElementById("curp").value;
    let email = document.getElementById("email").value;
    let telefono = document.getElementById("telefono").value;
    let id_cat_entidad_nacimiento = document.getElementById("id_cat_entidad_nacimiento").value;
    let id_clues = document.getElementById("id_clues").value;

    if (validarData(nombre, 'Nombre') &&
        validarData(primer_apellido, 'Apellido paterno') &&
        validarData(curp, 'CURP') &&
        validarData(email, 'Correos') &&
        validarData(telefono, 'No. Telefónico') &&
        validarData(id_cat_entidad_nacimiento, 'Entidad de nacimiento') &&
        validarData(id_clues, 'CLUES disponibles') &&
        campoInvalido(validarCurp(curp), 'CURP') &&
        caracteresCount('No. Telefónico', 10, telefono) &&
        validarEmail(email)) {
        // actualizarInformacionPos();
        validarClues();
    }
}


function validarClues() {


    Swal.fire({
        title: "¿Está seguro?",
        text: "Asegúrate de que tu información sea correcta, ya que solo podrás actualizarla una vez",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#235B4E",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Si, continuar",
        cancelButtonText: "Cancelar"
    }).then((result) => {


        if (result.isConfirmed) {
            let hiddenInput = document.getElementById('id_clues_result');
            let valor = hiddenInput.value;



            // Comprobar si el valor está vacío
            if (valor === null || valor.trim() === '') {
                $.post("../../../../App/Controllers/Central/PostulanteC/ValidateC.php", {
                    id_clues: $("#id_clues").val(),
                },
                    function (data) {
                        // console.log(data);

                        let jsonData = JSON.parse(data);
                        let bool = jsonData.bool;
                        if (bool) {
                            actualizarInformacionPos();
                            //console.log('agregar');
                        } else {
                            notyf.error('La CLUES ya ha sido asignada. Por favor, actualiza la página para reflejar los cambios.');
                        }
                    }
                );
            } else {
                //actualizarInformacionPos(); //Con info
                // console.log('agregar con exito');
                notyf.error('Tu procedimiento de actualización de datos ha finalizado');
            }
        }
        /*
        if (result.isConfirmed) {
        $.post("../../../../App/Controllers/Central/AsistenciaC/EliminarC.php", {
                id_object: id_object
            },
            function (data) {
                if (data == 'delete'){
                    notyf.success('Asistencia eliminada con éxito')
                } else {
                    notyf.error(mensajeSalida);
                }
                buscarAsistencia();
            }
        );
    }*/
    });







}

//actualizarInformacionPos();





























































///funciones auxiliares
///convierte el texto en mayuscula
function convertirAMayusculas(event, inputId) {
    let inputElement = document.getElementById(inputId);
    let texto = event.target.value;
    let textoEnMayusculas = texto.toUpperCase();
    inputElement.value = textoEnMayusculas;
}

function validarData(data, text) {
    let bool = true;
    if (validarNull(data)) {
        notyf.error('Campo ' + text + '* no puede estar vacio.');
        bool = false;
    }
    return bool;
}

function validarNull(cadena) {
    let bool = false;
    if (cadena.length === 0) {
        bool = true;
    }
    return bool;
}

function validarCurp(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)  //Coincide con el formato general?
        return false;

    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma = 0.0,
            lngDigito = 0.0;
        for (var i = 0; i < 17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10)
            return 0;
        return lngDigito;
    }
    if (validado[2] != digitoVerificador(validado[1]))
        return false;

    return true; //Validado
}

function campoInvalido(data, text) {
    let bool = true;
    if (!data) {
        notyf.error('Campo ' + text + '* no valido.');
        bool = false;
    }
    return bool;
}

function caracteresCount(text, number, value) {
    let bool = true;
    if (value.length != number) {
        bool = false
        notyf.error(text + ' debe tener ' + number + ' caracteres')
    }
    return bool;
}

function validarEmail(valor) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)) {
        return true; ///Email correcto
    } else {
        notyf.error('Correo electrónico no valido');
        return false; ///Email incorrecto
    }
}

function validarNumero(input) {
    input.value = input.value.replace(/[^\d]/g, '');
}
