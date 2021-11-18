<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Categorias as ControllersCategorias;
use Livewire\Component;
use App\Models\LivrosCategorias;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Categorias extends Component
{
    use LivewireAlert;
  

    public $id_categoria;
    public  $categorias , $categoria;
    public $updateMode = false;
  
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.categorias');
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
        $this->dispatchBrowserEvent('categoriaStore');



    }

    public function edit($id)
    {
     
        $this->updateMode = true;
        $categoria = LivrosCategorias::where('id',$id)->first();
        $this->categoria = $categoria->categoria;
        $this->id_categoria = $categoria->id;
     
        
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update($id)
    {
       

    
        $validatedDate = $this->validate([
            'categoria' => 'required',
          
           
        ]);

        if (!empty($id)) {

            $categoria = LivrosCategorias::find($id);
    

            $categoria->update([
                'categoria' => $this->categoria,
                
               
            ]);


            $this->updateMode = false;
            $this->alert('success', 'Livro Atualizado com Sucesso!');
            $this->resetInputFields();
            $this->emit('refreshComponent');
        }
    }
    public function delete($id)
    {
        if($id){
            LivrosCategorias::where('id',$id)->delete();
      
            $this->alert('success', 'Categoria deletada com Sucesso!');
    
            $this->dispatchBrowserEvent('categoriaStore');
            $this->refresh();
        }
    }
    public function refresh()
    {
        $this->emit('refreshComponent');
    }

}
