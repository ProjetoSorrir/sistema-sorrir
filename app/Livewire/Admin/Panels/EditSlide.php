<?php

namespace App\Livewire\Admin\Panels;

use App\Models\Slides;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSlide extends Component
{
    public string $tenant_id;
    public $slideId;
    public $name;
    public $status;
    public $image_alt;
    public $image_link;
    public $image;
    public $order;

    public function render()
    {
        return view('livewire.admin.panels.edit-slide');
    }


    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    public function loadSlideDetails()
    {
        tenancyFn($this->tenant_id);

        // Carregar os detalhes do slide com base no ID
        $slide = Slides::find($this->slideId);
        if ($slide) {
            $this->name = $slide->name;
            $this->status = $slide->status;
            $this->image_alt = $slide->image_alt;
            $this->image_link = $slide->image_link;
            $this->order = $slide->order;
            $this->image = $slide->image;
        }
        $this->dispatch('slideDetailsLoaded', [
            'name' => $this->name,
            'status' => $this->status,
            'image_alt' => $this->image_alt,
            'order' => $this->order,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'editing' => true
        ]);
    }
}
