<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
   <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Livro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Nome da Categoria </label>
                            <input type="text" class="form-control" wire:model="categoria" id="categoria" placeholder="Digite:o nome da Categoria">
                            @error('categoria') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                </div>
                 
            </div>
            </form>
       

   
        <div class="modal-footer">
            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" wire:click.prevent="update({{$id_categoria}})" class="btn btn-primary" data-dismiss="modal">Save changes</button>
        </div>
   </div>
</div>
</div>

