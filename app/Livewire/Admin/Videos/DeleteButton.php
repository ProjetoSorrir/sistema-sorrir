<?php

namespace App\Livewire\Admin\Videos;

use App\Models\Video;
use Livewire\Component;

class DeleteButton extends Component
{
    public $id;
    public string $tenant_id;

    public function mount($id, $tenantId)
    {
        $this->id = $id;
        $this->tenant_id = $tenantId;
    }

    public function deleteVideo($videoId)
    {
        tenancyFn($this->tenant_id);

        // Encontrar o vídeo pelo ID e deletá-lo
        $video = Video::find($videoId);
        if ($video) {
            $video->delete();

            session()->flash('message', 'Video successfully deleted.');
        }

        return redirect()->route('videos');
    }

    public function render()
    {
        return view('livewire.admin.videos.delete-button');
    }
}
