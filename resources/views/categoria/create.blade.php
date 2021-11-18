
<div  class="modal fade" id="categoria-create" tabindex="-1" role="dialog" aria-labelledby="categoria-create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoria-create">Adicionar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
            <form  class="form-control" action="{{route('categorias.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nome da Categoria</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" name="categoria">
                        @error('categoria') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="submit"class="btn btn-primary close-modal">Save changes</button>
            </div>
            
        </form>
        </div>
    </div>
</div>