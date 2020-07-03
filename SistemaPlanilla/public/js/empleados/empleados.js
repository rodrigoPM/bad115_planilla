function editar_estado(
    ID_EMPLEADO,
    CODIGO_EMPLEADO,
    NOMBRE_PRIMERO,
    NOMBRE_SEGUNDO,
    APELLIDO_PATERNO,
    APELLIDO_MATERNO,
    FECHA_NACIMIENTO,
    NUMERO_DOCUMENTO,
    FECHA_EXPEDICION,
    NIT,
    NUP,
    NUMERO_ISSS,
    FECHA_INGRESO,
    FECHA_CONTRATACION,
    SALARIO,
    CORREO_ELECTRONICO_INSTITUCIONAL,
    CORREO_ELECTRONICO_PERSONAL,
    HORARIO_TRABAJO,
    ID_PUESTO,
    ID_PROFESION_OFICIO,
    ID_ESTADO_CIVIL,
    ID_GENERO,
    ID_SUB_SECCION,
    ID_TIPO_CONTRATACION,
    ID_AFP,
    ID_ESTADO,
    ID_MUNICIPIO,
    ID_EMPLEADO_JEFE = 0
) {
    console.log('dentro de editar');
    
    limpiar_validaciones();
    $('#ID_PUESTO').val(ID_PUESTO);
    $('#ID_PUESTO').trigger('change');
    $('#ID_PROFESION_OFICIO').val(ID_PROFESION_OFICIO);
    $('#ID_PROFESION_OFICIO').trigger('change');
    $('#ID_ESTADO_CIVIL').val(ID_ESTADO_CIVIL);
    $('#ID_ESTADO_CIVIL').trigger('change');
    $('#ID_GENERO').val(ID_GENERO);
    $('#ID_GENERO').trigger('change');
    $('#ID_SUB_SECCION').val(ID_SUB_SECCION);
    $('#ID_SUB_SECCION').trigger('change');
    $('#ID_TIPO_CONTRATACION').val(ID_TIPO_CONTRATACION);
    $('#ID_TIPO_CONTRATACION').trigger('change');
    $('#ID_AFP').val(ID_AFP);
    $('#ID_AFP').trigger('change');
    $('#ID_ESTADO').val(ID_ESTADO);
    $('#ID_ESTADO').trigger('change');
    $('#ID_MUNICIPIO').val(ID_MUNICIPIO);
    $('#ID_MUNICIPIO').trigger('change');
    $('#ID_EMPLEADO_JEFE').val(ID_EMPLEADO_JEFE);
    $('#ID_EMPLEADO_JEFE').trigger('change');

    document.querySelector('#ID_EMPLEADO').value = ID_EMPLEADO;
    document.querySelector('#CODIGO_EMPLEADO').value = CODIGO_EMPLEADO;
    document.querySelector('#NOMBRE_PRIMERO').value = NOMBRE_PRIMERO;
    document.querySelector('#NOMBRE_SEGUNDO').value = NOMBRE_SEGUNDO;
    document.querySelector('#APELLIDO_PATERNO').value = APELLIDO_PATERNO;
    document.querySelector('#APELLIDO_MATERNO').value = APELLIDO_MATERNO;
    document.querySelector('#FECHA_NACIMIENTO').value = FECHA_NACIMIENTO;
    //document.querySelector('#DIRECCION').value = DIRECCION;
    document.querySelector('#NUMERO_DOCUMENTO').value = NUMERO_DOCUMENTO;
    document.querySelector('#FECHA_EXPEDICION').value = FECHA_EXPEDICION;
    document.querySelector('#NIT').value = NIT;
    document.querySelector('#NUP').value = NUP;
    document.querySelector('#NUMERO_ISSS').value = NUMERO_ISSS;
    document.querySelector('#FECHA_INGRESO').value = FECHA_INGRESO;
    document.querySelector('#FECHA_CONTRATACION').value = FECHA_CONTRATACION;
    document.querySelector('#SALARIO').value = SALARIO;
    document.querySelector('#CORREO_ELECTRONICO_INSTITUCIONAL').value = CORREO_ELECTRONICO_INSTITUCIONAL;
    document.querySelector('#CORREO_ELECTRONICO_PERSONAL').value = CORREO_ELECTRONICO_PERSONAL;
    /*     document.querySelector('#TELEFONO').value = TELEFONO;
        document.querySelector('#TELEFONO_MOVIL').value = TELEFONO_MOVIL; */
    document.querySelector('#HORARIO_TRABAJO').value = HORARIO_TRABAJO;

    submit_form();
}

function limpiar() {
    document.querySelector('#ID_EMPLEADO').value = '';
    document.querySelector('#CODIGO_EMPLEADO').value = '';
    document.querySelector('#NOMBRE_PRIMERO').value = '';
    document.querySelector('#NOMBRE_SEGUNDO').value = '';
    document.querySelector('#APELLIDO_PATERNO').value = '';
    document.querySelector('#APELLIDO_MATERNO').value = '';
    document.querySelector('#FECHA_NACIMIENTO').value = '';
    //document.querySelector('#DIRECCION').value = '';
    document.querySelector('#NUMERO_DOCUMENTO').value = '';
    document.querySelector('#FECHA_EXPEDICION').value = '';
    document.querySelector('#NIT').value = '';
    document.querySelector('#NUP').value = '';
    document.querySelector('#NUMERO_ISSS').value = '';
    document.querySelector('#FECHA_INGRESO').value = '';
    document.querySelector('#FECHA_CONTRATACION').value = '';
    document.querySelector('#SALARIO').value = '';
    document.querySelector('#CORREO_ELECTRONICO_INSTITUCIONAL').value = '';
    document.querySelector('#CORREO_ELECTRONICO_PERSONAL').value = '';
    /* document.querySelector('#TELEFONO').value = '';
    document.querySelector('#TELEFONO_MOVIL').value = ''; */
    document.querySelector('#HORARIO_TRABAJO').value = '';

    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function eliminar(id_empleado){
    document.querySelector('#id_eliminar').value = id_empleado;
}
