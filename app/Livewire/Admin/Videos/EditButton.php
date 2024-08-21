<?php

namespace App\Livewire\Admin\Videos;

use Livewire\Component;
use App\Models\Video;

class EditButton extends Component
{
    public string $tenant_id;
    public $videoId;
    public string $background_color;
    public string $text_color;
    public string $link;
    public string $text;
    public bool $editing = true;

    public function render()
    {
        tenancyFn($this->tenant_id);
        return view('livewire.admin.videos.edit-button');
    }

    public function mount($videoId)
    {
        $this->tenant_id = getTenantId();
        $this->videoId = $videoId;
    }

    public function loadVideoDetails()
    {
        tenancyFn($this->tenant_id);

        $video = Video::find($this->videoId);
        if ($video) {
            $this->background_color = $video->background_color;
            $this->text_color = $video->text_color;
            $this->link = $video->link;
            $this->text = $video->text;
        }
        $this->dispatch('videoDetailsLoaded', [
            'background_color' => $this->background_color,
            'text_color' => $this->text_color,
            'link' => $this->link,
            'text' => $this->text,
            'editing' => $this->editing
        ]);
    }
}
