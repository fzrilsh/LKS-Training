<?php

namespace App\Livewire\ClientPage;

use App\Models\Module;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.clientarea')]
#[Title('Add New Task | Client Area')]
class AddTask extends Component
{
    use Interactions;

    public User $user;
    public int $selectedModule;
    public ?Module $selectedModuleInstance;
    public $categories;

    public function mount(){
        $this->user = auth('web')->user();
        $this->categories = Module::all()->map(fn($v) => ['id' => $v->id, 'name' => $v->name, 'description' => strtoupper($v->category)])->values();
    }
    
    public function render()
    {
        return view('livewire.client-page.add-task');
    }

    public function updatedselectedModule($value){
        $this->selectedModuleInstance = Module::query()->find($value);
    }

    public function checkTask(){
        if($this->user->ModuleTasks()->getQuery()->where('module_id', $this->selectedModule)->first()){
            $this->toast()
                ->timeout(10)
                ->question('Module Sudah Pernah Dikerjakan.', 'Kamu sudah pernah mengerjakan module ini, ingin kerjakan lagi?')
                ->confirm('IYA', 'startModule')
                ->cancel('TIDAK')
                ->send();
            
            return false;
        }

        $this->startModule();
    }

    public function startModule(){
        $task = $this->selectedModuleInstance->Tasks()->create([
            'user_id' => $this->user->id,
            'json_marking' => $this->selectedModuleInstance->marking->json
        ]);

        $this->toast()->timeout(5)->success('Selamat Mengerjakan!', 'Module berhasil di daftarkan, selamat mengerjakan.')->flash()->send();
        return redirect()->route('clientarea.detail-task', $task);
    }
}
