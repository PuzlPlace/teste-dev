<div>
 
    <a href="{{route('livros.create')}}" class="btn btn-primary"> Adicionar Livro</a>

    @include('livros.editar')
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">x
          {{ session('message') }}
        </div>
    @endif
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Lancamento</th>
                <th>Tipo</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>

      
            @foreach($livros as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->titulo }}</td>
                <td>{{ $value->autor }}</td>
                <td>{{ $value->editora }}</td>
                <td>{{ $value->ano }}</td>
                <td>
                    @if($value->tipo == 1)
                        {{ 'FiSICO' }}
                    @else
                        {{ 'DIGITAL' }}
                 
                    @endif
                </td>
                <td>
                <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Editar</button>
             
                </td>
                <td>
                    <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            $('#livro-create').modal('hide');
        });
    </script>
</div>