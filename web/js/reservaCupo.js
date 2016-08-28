function reservarCupo(IdProyecto, IdPersona){
//    alert(IdProyecto+' '+IdPersona);
    if(confirm('Esta seguro de reservar cupo ?')){
        $('.proyecto-apply').attr('disabled', true);
        $.ajax({
            url : '/proyecto/guardar-reserva-cupo',
            data : {'IdProyecto' : IdProyecto, 'IdPersona' : IdPersona},
            success  : function(data) {
                $('.modal-body').html(data);
                $('#btnRefreshConsultaProyectos').trigger('click');
            }
        });        
    }
}



