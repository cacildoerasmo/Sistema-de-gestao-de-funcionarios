$(document).ready(function(){
    $('a[data-confirm]').click(function(ev){
        var href = $(this).attr('href');
        if (!$('#confirm-delete').length){
            $('body').append('<div class="modal" style="position: relative; top: 100px; left: -420px;" id="confirm-delete" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white">REMOVER USUÁRIO<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem a certeza de que deseja remover o usuário selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOK">Remover</a></div></div></div></div>');
        }
        $('#dataConfirmOK').attr('href', href);
        $('#confirm-delete').modal({show: true});
        return false;
    });
});