<?php

namespace App\Livewire\Admin\Videos;

use App\Models\Video;
use Livewire\Attributes\On;
use Livewire\Component;

class Videos extends Component
{
    public string $tenant_id;
    public string $background_color;
    public string $text_color;
    public string $link;
    public string $text;
    public bool $editing = false;
    public bool $showInput = true;

    public function render()
    {
        tenancyFn($this->tenant_id);

        return view('livewire.admin.videos.videos', [
            'video' => Video::latest()->first(),
        ]);
    }

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }


    public function submit()
    {
        tenancyFn($this->tenant_id);

        $this->validate([
            'background_color' => 'nullable',
            'text_color' => 'nullable',
            'link' => 'required',
            'text' => 'nullable',
        ], ['link.required' => 'O campo link é obrigatório.']);

        Video::create([
            'background_color' => $this->background_color,
            'text_color' => $this->text_color,
            'link' => $this->link,
            'text' => $this->text,
        ]);

        session()->flash('success', 'Vídeo adicionado com sucesso.');
        $this->reset();
        return redirect()->route('videos');
    }

    #[On('videoDetailsLoaded')]
    public function updateVideoDetails($videoDetails)
    {
        tenancyFn($this->tenant_id);

        $this->background_color = $videoDetails['background_color'];
        $this->text_color = $videoDetails['text_color'];
        $this->link = $videoDetails['link'];
        $this->text = $videoDetails['text'];
        $this->editing = true;
        $this->showInput = true;
    }

    public function updateVideo()
    {
        tenancyFn($this->tenant_id);

        $this->validate([
            'background_color' => 'nullable',
            'text_color' => 'nullable',
            'link' => 'required',
            'text' => 'nullable',
        ], ['link.required' => 'O campo link é obrigatório.']);

        $video = Video::latest()->first();
        if (!$video) {
            session()->flash('error', 'Vídeo não encontrado.');
            return redirect()->route('videos');
        }
        $video->update([
            'background_color' => $this->background_color,
            'text_color' => $this->text_color,
            'link' => $this->link,
            'text' => $this->text,
        ]);

        $video->save();

        session()->flash('success', 'Vídeo atualizado com sucesso.');
        $this->reset();
        return redirect()->route('videos');
    }
}
