function editar_estado(id, nombre){
    limpiar_validaciones();
    document.querySelector('#ID_ROL').value = id;
    document.querySelector('#NOMBRE_ROL').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_ROL').value = '';
    document.querySelector('#NOMBRE_ROL').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function eliminar(id_tipo){
    document.querySelector('#id_eliminar').value = id_tipo;
}