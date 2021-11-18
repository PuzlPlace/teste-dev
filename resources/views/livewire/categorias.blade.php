<div>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoria-create">
        Adicionar Categoria
    </button>
    @include('categoria.create')
    @include('categoria.editar')
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
                <th>Data da Criação</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>

      
            @foreach($categorias as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->categoria }}</td>
                <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
              
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
        window.livewire.on('categoriaStore', () => {
            $('#categoria-create').modal('hide');
        });
    </script>
</div>
