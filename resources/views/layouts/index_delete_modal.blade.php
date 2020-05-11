<div class="modal inmodal" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fas fa-trash modal-icon"></i>
                <h4 class="modal-title">Eliminar <b id="modal-element-name"></b></h4>
                <small class="font-bold">El registro se eliminará permanentemente.</small>
            </div>
            <div class="modal-body">
                <p>Al presionar el boton <b>Eliminar</b> ya no podrás recuperar la información del registro, ni información relacionada a él.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <form id="modal-delete-form" method="POST" class="form-horizontal" style="display: inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>