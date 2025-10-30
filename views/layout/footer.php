    </div> <!-- /container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departamento = document.getElementById('departamento');
            const provincia = document.getElementById('provincia');
            const distrito = document.getElementById('distrito');

            departamento.addEventListener('change', function() {
                const departamentoId = this.value;
                provincia.innerHTML = '<option value="">Seleccione provincia</option>';
                distrito.innerHTML = '<option value="">Seleccione distrito</option>';
                distrito.disabled = true;

                if (departamentoId) {
                    fetch(`index.php?controller=trabajadores&action=getProvinciasByDepartamento&departamento_id=${departamentoId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            data.forEach(function(prov) {
                                const option = document.createElement('option');
                                option.value = prov.id;
                                option.textContent = prov.descripcion;
                                provincia.appendChild(option);
                            });
                            provincia.disabled = false;
                        });
                } else {
                    provincia.disabled = true;
                }
            });

            provincia.addEventListener('change', function() {
                const provinciaId = this.value;
                distrito.innerHTML = '<option value="">Seleccione distrito</option>';
                distrito.disabled = true;

                if (provinciaId) {
                    fetch(`index.php?controller=trabajadores&action=getDistritosByProvincia&provincia_id=${provinciaId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function(dist) {
                                const option = document.createElement('option');
                                option.value = dist.id;
                                option.textContent = dist.descripcion;
                                distrito.appendChild(option);
                            });
                            distrito.disabled = false;
                        });
                } else {
                    distrito.disabled = true;
                }
            });

            const numeroDocumentoInput = document.querySelector('input[name="numero_documento"]');
            numeroDocumentoInput.addEventListener('blur', function() {
                const numeroDocumento = this.value;
                if (numeroDocumento) {
                    fetch(`index.php?controller=trabajadores&action=validDocumentDuplicate&numero_documento=${numeroDocumento}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                alert('El número de documento ya existe. Por favor, ingrese uno diferente.');
                                numeroDocumentoInput.value = '';
                                numeroDocumentoInput.focus();
                            }
                        });
                }
            });

        });
    </script>
    <!-- // jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/localization/messages_es.min.js"></script>

    <script>
        // inicializar jquery
        $(document).ready(function() {

            $('select[name="tipo_documento"]').on('change', function() {
                var tipoDocumento = $(this).val();
                var numeroDocumentoInput = $('input[name="numero_documento"]');

                numeroDocumentoInput.val('').removeClass('is-valid is-invalid');

                if (tipoDocumento === 'DNI') {
                    numeroDocumentoInput.attr('maxlength', '8');
                    numeroDocumentoInput.attr('minlength', '8');
                    numeroDocumentoInput.rules('remove');
                    numeroDocumentoInput.rules('add', {
                        required: true,
                        digits: true,
                        minlength: 8,
                        maxlength: 8,
                        messages: {
                            required: "Por favor ingrese el número de DNI",
                            digits: "El DNI solo debe contener dígitos",
                            minlength: "El DNI debe tener exactamente 8 dígitos",
                            maxlength: "El DNI debe tener exactamente 8 dígitos"
                        }
                    });
                } else if (tipoDocumento === 'RUC') {
                    numeroDocumentoInput.attr('maxlength', '11');
                    numeroDocumentoInput.attr('minlength', '11');
                    numeroDocumentoInput.rules('remove');
                    numeroDocumentoInput.rules('add', {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 11,
                        messages: {
                            required: "Por favor ingrese el número de RUC",
                            digits: "El RUC solo debe contener dígitos",
                            minlength: "El RUC debe tener exactamente 11 dígitos",
                            maxlength: "El RUC debe tener exactamente 11 dígitos"
                        }
                    });
                } else if (tipoDocumento === 'Pasaporte') {
                    numeroDocumentoInput.attr('maxlength', '12');
                    numeroDocumentoInput.attr('minlength', '6');
                    numeroDocumentoInput.rules('remove');
                    numeroDocumentoInput.rules('add', {
                        required: true,
                        minlength: 12,
                        maxlength: 12,
                        messages: {
                            required: "Por favor ingrese el número de pasaporte",
                            minlength: "El pasaporte debe tener al menos 12 caracteres",
                            maxlength: "El pasaporte no puede exceder 12 caracteres"
                        }
                    });
                }
            });


            $("#formTrabajador").validate({

                rules: {
                    nombre: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        lettersonly: true
                    },
                    apellido_paterno: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        lettersonly: true
                    },
                    apellido_materno: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        lettersonly: true
                    },
                    tipo_documento: {
                        required: true
                    },
                    numero_documento: {
                        required: true,
                        digits: true,
                        minlength: 8,
                        maxlength: 11
                    },
                    sexo: {
                        required: true
                    },
                    fecha_nacimiento: {
                        required: true,
                        date: true
                    },
                    departamento: {
                        required: true
                    },
                    provincia: {
                        required: true
                    },
                    distrito: {
                        required: true
                    },
                    direccion: {
                        required: true,
                        minlength: 5,
                        maxlength: 200
                    }
                },
                messages: {
                    nombre: {
                        required: "Por favor ingrese el nombre",
                        minlength: "El nombre debe tener al menos 2 caracteres",
                        maxlength: "El nombre no puede exceder 50 caracteres",
                        lettersonly: "El nombre solo debe contener letras"
                    },
                    apellido_paterno: {
                        required: "Por favor ingrese el apellido paterno",
                        minlength: "El apellido debe tener al menos 2 caracteres",
                        maxlength: "El apellido no puede exceder 50 caracteres",
                        lettersonly: "El apellido solo debe contener letras"
                    },
                    apellido_materno: {
                        required: "Por favor ingrese el apellido materno",
                        minlength: "El apellido debe tener al menos 2 caracteres",
                        maxlength: "El apellido no puede exceder 50 caracteres",
                        lettersonly: "El apellido solo debe contener letras"
                    },
                    tipo_documento: {
                        required: "Por favor seleccione el tipo de documento"
                    },
                    numero_documento: {
                        required: "Por favor ingrese el número de documento",
                        digits: "El número de documento solo debe contener dígitos",
                        minlength: "El número de documento debe tener al menos 8 dígitos",
                        maxlength: "El número de documento no puede exceder 11 dígitos"
                    },
                    sexo: {
                        required: "Por favor seleccione el sexo"
                    },
                    fecha_nacimiento: {
                        required: "Por favor ingrese la fecha de nacimiento",
                        date: "Por favor ingrese una fecha válida"
                    },
                    departamento: {
                        required: "Por favor seleccione el departamento"
                    },
                    provincia: {
                        required: "Por favor seleccione la provincia"
                    },
                    distrito: {
                        required: "Por favor seleccione el distrito"
                    },
                    direccion: {
                        required: "Por favor ingrese la dirección",
                        minlength: "La dirección debe tener al menos 5 caracteres",
                        maxlength: "La dirección no puede exceder 200 caracteres"
                    }
                },
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });

            //validar solo letras y espacios
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-záéíóúñÁÉÍÓÚÑ\s]+$/i.test(value);
            }, "Por favor ingrese solo letras");

            // mayor de edad
            $('body').on('change', 'input[name="fecha_nacimiento"]', function() {
                var fechaNacimiento = new Date($(this).val());
                var hoy = new Date();
                var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                var m = hoy.getMonth() - fechaNacimiento.getMonth();
                if (m < 0 || (m === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }
                if (edad < 18) {
                    alert('El trabajador debe ser mayor de edad.');
                    $(this).val('');
                }

                if (isNaN(fechaNacimiento.getTime())) {
                    alert('Por favor ingrese una fecha de nacimiento válida.');
                    $(this).val('');
                }
            });


        });
    </script>

    </body>

    </html>