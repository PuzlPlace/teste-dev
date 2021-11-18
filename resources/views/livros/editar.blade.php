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
                                <label for="exampleFormControlInput2">Titulo </label>
                                <input type="text" class="form-control" wire:model="titulo" id="titulo" placeholder="Digite: o Titulo">
                                @error('titulo') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nome do Autor</label>
                                <input type="text" class="form-control" wire:model="autor" id="autor" placeholder="Digite: Nome do Autor">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Formato </label>
                                <select class="form-control" id="tipo">
                                   <option value="1">Fisico</option>
                                   <option value="0">Digital</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Editora </label>
                                <input type="email" class="form-control" wire:model="editora" id="editora" placeholder="Digite: o nome da Editora">
                                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Ano do Lançamento</label>
                                <input type="text" class="form-control" wire:model="ano" id="ano" placeholder="Digite: Ano de Lançamento ">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Paginas</label>
                                <input type="text" class="form-control" wire:model="paginas" id="paginas" placeholder="Digite: Nome do Autor">
                                @error('paginas') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Descrição</label>
                                <textarea class="form-control" wire:model="descricao" id="descricao" rows="3" cols="20" style="min-width: 100%"></textarea>
                               
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Selecione um Arquivo de Imagen</label>
                            <input type="file" class="form-control" wire:model="imagem">
                            @error('imagem') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Categoria </label>
                            <select class="form-control" id="id_categoria">
                                @if (!empty($categorias))
                                
                         
                               @foreach ($categorias as $categoria) 
                               <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                               @endforeach
                               @endif
                            </select>
                        </div>
                    </div>
                     
                </div>
                </form>
            </div>

         
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update({{$id_livro}})" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>