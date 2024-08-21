<?php

namespace App\Livewire\Admin\Panels;

use App\Models\Slides;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use function Laravel\Prompts\confirm;

class DeleteButton extends Component
{
    public $id;
    public string $tenant_id;

    public function mount($id, $tenantId)
    {
        $this->id = $id;
        $this->tenant_id = $tenantId;
    }

    public function deleteSlide($slideId)
    {
        tenancyFn($this->tenant_id);

        // Encontrar o slide pelo ID e deletá-lo
        $slide = Slides::find($slideId);
        if ($slide) {
            // Obter todos os slides com ordem maior que a do slide excluído
            $slidesToUpdate = Slides::where('order', '>', $slide->order)->get();

            // Decrementar a ordem desses slides restantes
            foreach ($slidesToUpdate as $slideToUpdate) {
                $slideToUpdate->order -= 1;
                $slideToUpdate->save();
            }

            // Deletar o slide
            $slide->delete();

            // Deleta a imagem do storage
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }

            session()->flash('message', 'Slide successfully deleted.');
        }

        return redirect()->route('panel');
    }

    public function confirmSlideDeletion($slideId)
    {
        tenancyFn($this->tenant_id);
        if (confirm('Are you sure you want to delete this slide?')) {
            $this->deleteSlide($slideId);
        }
    }

    public function render()
    {
        return view('livewire.admin.panels.delete-button');
    }
}
