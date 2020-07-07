function editar_estado(
    ID_CODIGO,
    ID_TIPO_MOVIMIENTO = 0,
    NOMBRE_CONCEPTO,
    APLICA_SEGURO,
    APLICA_AFP,
    APLICA_SEGURO,
    TIPO,
    PREFIJO,
    ){
        limpiar_validaciones();
        $('#ID_CODIGO').val(ID_CODIGO);
        $('#ID_CODIGO').trigger('change');
        $('#ID_TIPO_MOVIMIENTO').val(ID_TIPO_MOVIMIENTO);
        $('#ID_TIPO_MOVIMIENTO').trigger('change');
        $('#NOMBRE_CONCEPTO').val(NOMBRE_CONCEPTO);
        $('#NOMBRE_CONCEPTO').trigger('change');
        $('#APLICA_SEGURO').val(APLICA_SEGURO);
        $('#APLICA_SEGURO').trigger('change');
        $('#APLICA_AFP').val(APLICA_AFP);
        $('#APLICA_AFP').trigger('change');
        $('#APLICA_RENTA').val(APLICA_RENTA);
        $('#APLICA_RENTA').trigger('change');
        $('#TIPO').val(TIPO);
        $('#TIPO').trigger('change');
        $('#PREFIJO').val(PREFIJO);
        $('#PREFIJO').trigger('change');

    
        document.querySelector('#ID_CODIGO').value = ID_CODIGO; 
        document.querySelector('#NOMBRE_CONCEPTO').value = NOMBRE_CONCEPTO;
        document.querySelector('#APLICA_SEGURO').value = APLICA_SEGURO;
        document.querySelector('#APLICA_AFP').value = APLICA_AFP;
        document.querySelector('#APLICA_RENTA').value = APLICA_RENTA;
        document.querySelector('#TIPO').value = TIPO;
        document.querySelector('#PREFIJO').value = PREFIJO;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_CODIGO').value = '';
        document.querySelector('#NOMBRE_CONCEPTO').value = '';
        document.querySelector('#APLICA_SEGURO').value = '';
        document.querySelector('#APLICA_AFP').value = '';
        document.querySelector('#APLICA_RENTA').value = '';
        document.querySelector('#TIPO').value = '';
        document.querySelector('#PREFIJO').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }