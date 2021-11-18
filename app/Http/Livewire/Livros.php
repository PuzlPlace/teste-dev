<?php

namespace App\Http\Livewire;

use App\Models\Livros as ModelLivros;
use App\Models\LivrosCategorias;
use GuzzleHttp\Psr7\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\File; 
class Livros extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $livros;
    public  $categorias , $categoria, $titulo, $autor, $editora, $ano, $edicao, $isbn, $paginas, $descricao, $categoria_id ,$imagem ,$imagembanco;
    public $updateMode = false;
    public $id_livro;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.livros');
    }

    public function mount()
    {
        $this->categorias  = LivrosCategorias::all();
    }

    private function resetInputFields(){
        $this->categoria = '';
     
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'categoria' => 'required',
        
        ]);

        LivrosCategorias::create($validatedDate);

        $this->alert('success', 'Categoria Adicionada com Sucesso!');
        $this->resetInputFields();

        $this->emit('userStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
     
        $this->updateMode = true;
        $livro = ModelLivros::where('id',$id)->first();
        $this->titulo = $livro->titulo;
        $this->id_livro = $livro->id;
        $this->autor = $livro->autor;
        $this->editora = $livro->editora;
        $this->ano = $livro->ano;
        $this->edicao = $livro->edicao;
        $this->tipo = $livro->tipo;
        $this->paginas = $livro->paginas;
        $this->descricao = $livro->descricao;
        $this->imagembanco = $livro->imagem;
        $this->id_categoria = $livro->id_categoria;
      
        
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update($id)
    {
       

    
        $validatedDate = $this->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'titulo' => 'required',
            'tipo' => 'required',
            'paginas' => 'required',
            'autor' => 'required',
            'id_categoria' => 'required',
            'descricao' => 'required',
           
        ]);

        if (!empty($id)) {

            $livros = ModelLivros::find($id);
    
             if(!empty($this->imagem)){
                $extensao = $this->imagem->extension();
                $nomeImagem = "{$id}.{$extensao}";
                $this->imagem->storeAs('photos', $nomeImagem);
                File::delete($this->imagem-> getRealPath());
       
        }
            if(empty($this->imagem)){
                $nomeImagem = $this->imagembanco;
            }
    
            $livros->update([
                'titulo' => $this->titulo,
                'autor' => $this->autor,
                'editora' => $this->editora,
                'ano' => $this->ano,
                'edicao' => $this->edicao,
                'paginas' => $this->paginas,
                'descricao' => $this->descricao,
                'imagem' => $nomeImagem,
                'id_categoria' => $this->id_categoria,
               
            ]);


            $this->updateMode = false;
            $this->alert('success', 'Livro Atualizado com Sucesso!');
            $this->resetInputFields();
            return redirect()->route('livros.index');
        }
    }
    public function delete($id)
    {
        if($id){
            ModelLivros::where('id',$id)->delete();
      
            $this->alert('success', 'Livro Atualizado com Sucesso!');
            
            $this->refresh();
          
          
        }
    }
    public function refresh()
    {
        $this->emit('refreshComponent');
    }

}
