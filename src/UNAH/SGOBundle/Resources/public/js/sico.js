function SICO() {
    var boton = $('<a class="btn" href="#">Nuevo Tipo de Acción</a>');
    boton.click(function() {
        $('#dialog-tipo-accion').dialog('open');
    });
    $(boton).insertAfter("#unah_sgobundle_acciontype_tipo");
    
    var boton2 = $('<a class="btn" href="#">Nuevo Tipo de Solicitud</a>');
    boton2.click(function() {
        $('#dialog-tipo-solicitud').dialog('open');
    });
    $(boton2).insertAfter("#unah_sgobundle_documentorecibidotype_tipoSolicitud");
    
    var boton3 = $('<a class="btn" href="#">Nuevo Emisor o Receptor</a>');
    boton3.click(function() {
        $('#dialog-departamento').dialog('open');
    });
    $("<br />").insertAfter("#unah_sgobundle_documentorecibidotype_emisor");
    $(boton3).insertAfter("#unah_sgobundle_documentorecibidotype_emisor");
    $("<br />").insertAfter("#unah_sgobundle_documentorecibidotype_emisor");
    $(boton3).insertBefore("#unah_sgobundle_documentotype_receptores");
    
    $('.datepicker').datepicker({
        dateFormat : 'dd/mm/yy',
	  changeMonth: true,
	  changeYear: true
    });
    $('.colorpicker').colorpicker();
    $('.form-dialog').dialog({
        autoOpen : false
    });
    $('input.datetimepicker').datetimepicker(
	{
	  dateFormat : 'dd/mm/yy',
	  changeMonth: true,
	  changeYear: true
	});
    $('.chosen-select').chosen({
    	allow_single_deselect: true
    });
    $('.ajax-form').submit(function(event){
    	event.preventDefault();
		var form = $(this);
	    var url = form.attr('action');
	    var posting = $.post(url, form.serialize()).done(function() {
	    	location.reload();
	    });
    });
}

SICO.prototype.departamentos = function(url){
	var emisores = $("#unah_sgobundle_documentorecibidotype_emisor");
	if($("#unah_sgobundle_documentorecibidotype_emisor").length != 0){
		$.get(url, function(json) {
			obj = $.parseJSON(json.trim());
			$.each(obj, function(i, tipo){
				var boton = $('<a href="#" class="btn" >'+ tipo.nombre +'</a>');
				boton.click(function (){
					emisores.empty();
					var option;
					$.each(tipo.departamentos, function(i, departamento) {
						option = $('<option />');
						option.val(departamento.id);
						option.html(departamento.nombre);
						emisores.append(option);
					});
				});
				$(boton).insertBefore("#unah_sgobundle_documentorecibidotype_emisor");
			});
		});	
	}
}