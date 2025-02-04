<?php

namespace App\Livewire\ClientPage;

use App\Models\Module;
use App\Models\ModuleTask;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.clientarea')]
#[Title('Detail Module | Client Area')]
class ModuleDetail extends Component
{
    use Interactions;

    public ?Module $module;
    public ?ModuleTask $task;
    public $marked = [];
    public $timeElapsed;

    public function mount(string $task_id){
        $this->task = ModuleTask::query()->findOrFail($task_id);
        if($this->task) {
            $this->module = $this->task->Module()->first();
            $this->marked = collect(json_decode($this->task->json_marking, true))->map(fn($v) => $v['point'] > 0)->toArray();
        }
    }

    public function render()
    {
        return view('livewire.client-page.module-detail');
    }

    public function updateTime(){
        if($this->task->status === 'completed' || $this->task->status === 'on-marking') {
            $this->timeElapsed = $this->task->created_at->diff($this->task->updated_at)->format("%H Jam %I Menit %S Detik");
        }else{
            $this->timeElapsed = $this->task->created_at->diff(\Carbon\Carbon::now())->format("%H Jam %I Menit %S Detik");
        }
    }

    public function saveMark(){
        $marking = json_decode($this->task->json_marking, true);

        foreach ($this->marked as $index => $value) {
            $marking[$index]['point'] = $marking[$index]['total_point'];
        }

        $this->task->update([
            'json_marking' => json_encode($marking)
        ]);

        $this->toast()->timeout(5)->success('Saved!', 'Marking berhasil di simpan.')->send();
        $this->task->update([ 'status' => 'completed' ]);
    }

    public function removeModule(){
        $this->toast()->timeout(10)->question('Hapus Pengerjaan', 'Yakin ingin menghapusnya?')->confirm('IYA', 'confirmRemoveModule')->cancel('TIDAK')->send();
    }

    public function confirmRemoveModule(){
        $this->task->delete();
        return redirect()->route('clientarea.dashboard');
    }

    public function setOnMarking(){
        $this->task->update([ 'status' => 'on-marking' ]);
    }

    public function setUncompleted(){
        $this->task->update([ 'status' => 'not-completed' ]);
    }

    public function downloadAsset(){
        return response()->download(Storage::path($this->module->media_path));
    }

    public function downloadSoal(){
        return response()->download(Storage::path($this->module->exercise_path));
    }
}
