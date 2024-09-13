<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="agregar_editar_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header background-modal">
                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <img src="../../../../assets/sirh/logo_licencia.png"
                                style="max-width: 120%;margin-top: 20px;">
                        </div>
                        <div class="col-11">
                            <h1 class="text-tittle-card"><label id="titulolicencia"></label>
                                Actualizar Informaci&oacuten.
                            </h1>
                            <p class="color-text-white">Es fundamental validar que la información sea correcta.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-spacing"></div>
            <div class="card-body">
                <div class="container">

                    <div class="row mx-1">
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 mb-4">
                            <fieldset disabled>
                                <label for="campo"
                                    class="text-input-rem form-label input-text-form">Nombre</label><label
                                    class="text-required"></label>
                                <input type="text" placeholder="Nombre completo"
                                    onkeyup="convertirAMayusculas(event,'postulante')" class="form-control custom-input"
                                    id="postulante" maxlength="80">
                                <div class="line"></div>
                            </fieldset>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">Cédula
                                Prof.</label><label class="text-required"></label>
                            <input type="text" id="cedula_sep" maxlength="25"
                                onkeyup="convertirAMayusculas(event,'cedula_sep')" placeholder="Cédula profesional"
                                class="form-control custom-input">
                            <div class="line"></div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-5 col-xl-5 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">Carrera</label><label
                                class="text-required"></label>
                            <input type="text" placeholder="Carrera"
                                onkeyup="convertirAMayusculas(event,'desc_cedula_sep')"
                                class="form-control custom-input" id="desc_cedula_sep" maxlength="40">
                            <div class="line"></div>
                        </div>
                    </div>

                    <div class="row mx-1">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">Nombre</label><label
                                class="text-required">*</label>
                            <input type="text" id="nombre" placeholder="Nombre"
                                onkeyup="convertirAMayusculas(event,'nombre')" class="form-control custom-input"
                                maxlength="45">
                            <div class="line"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="email" class="text-input-rem form-label input-text-form">Apellido
                                paterno</label><label class="text-required">*</label>
                            <input type="text" id="primer_apellido"
                                onkeyup="convertirAMayusculas(event,'primer_apellido')" maxlength="30"
                                placeholder="Apellido paterno" class="form-control custom-input">
                            <div class="line"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="email" class="text-input-rem form-label input-text-form">Apellido
                                materno</label><label class="text-required"></label>
                            <input type="text" onkeyup="convertirAMayusculas(event,'segundo_apellido')"
                                id="segundo_apellido" maxlength="30" placeholder="Apellido materno"
                                class="form-control custom-input">
                            <div class="line"></div>
                        </div>
                    </div>


                    <div class="row mx-1">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">CURP</label><label
                                class="text-required">*</label>
                            <input type="text" id="curp" placeholder="CURP" onkeyup="convertirAMayusculas(event,'curp')"
                                class="form-control custom-input" maxlength="18">
                            <div class="line"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">Correo</label><label
                                class="text-required">*</label>
                            <input type="email" id="email" maxlength="35" placeholder="Correo"
                                class="form-control custom-input">
                            <div class="line"></div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <label for="campo" class="text-input-rem form-label input-text-form">No.
                                Telefónico</label><label class="text-required">*</label>
                            <input oninput="validarNumero(this)" type="number" placeholder="No. Telefónico"
                                class="form-control custom-input" id="telefono" maxlength="80">
                            <div class="line"></div>
                        </div>
                    </div>


                    <!--
                    <div class="row mx-1">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <fieldset disabled>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="campo" class="text-input-rem form-label input-text-form">Entidad de
                                            nacimiento</label>
                                        <label class="text-required">*</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control custom-select selectpicker"
                                            data-style="input-select-selectpicker" aria-label="Default select example"
                                            data-live-search="true" id="id_cat_entidad_nacimiento"
                                            data-none-results-text="Sin resultados">
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>


                    </div>
-->

                    <div class="container">
                        <p>Elige la CLUES adecuada según tu preferencia*</p>
                    </div>


                    <div class="row mx-1">
                        <div class="col-12 col-md-12 col-lg-8 col-xl-8 mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="text-input-rem form-label input-text-form">CLUES
                                        disponibles</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_clues" data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <fieldset disabled>
                                <label for="campo" class="text-input-rem form-label input-text-form">Entidad
                                    CLUE</label><label class="text-required"></label>
                                <input type="text" placeholder="Entidad de CLUE" class="form-control custom-input"
                                    id="id_cat_entidad" maxlength="80">
                                <div class="line"></div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="row mx-1">
                        <div class="col-12 col-xl-12 mb-4">
                            <fieldset disabled>
                                <label for="campo" class="text-input-rem form-label input-text-form">Nombre
                                    CLUE</label><label class="text-required"></label>
                                <input type="text" placeholder="Nombre de CLUE" class="form-control custom-input"
                                    id="nombre_unidad" maxlength="80">
                                <div class="line"></div>
                            </fieldset>
                        </div>
                    </div>




                    <div class="div-spacing"></div>
                    <div class="modal-footer">
                        <button onclick="ocultarAgregarEditar();" type="button" class="btn btn-secondary"
                            data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                        <button type="button" class="btn btn-success save-botton-modal"
                            onclick="return validarDataPost();"><i class="fas fa-save"></i> Guardar</button>
                        <input type="hidden" id="id_clues_result">
                    </div>
                </div>
            </div>
        </div>