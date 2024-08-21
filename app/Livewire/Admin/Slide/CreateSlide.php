<?php

namespace App\Livewire\Admin\Slide;

use App\Models\Slides;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;

class CreateSlide extends Component
{
    use WithFileUploads;

    public string $tenant_id;
    public $name;
    public $status;
    public $image_alt;
    public $image_link;
    public $order;
    public $image;
    public $slide_image;
    public $editing;

    public function mount()
    {
        $storagePath = storage_path('framework/cache');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }
        $this->tenant_id = getTenantId();
    }

    #[On('slideDetailsLoaded')]
    public function updateList($slideDetails)
    {
        $this->name = $slideDetails['name'];
        $this->status = $slideDetails['status'];
        $this->image_alt = $slideDetails['image_alt'];
        $this->image_link = $slideDetails['image_link'];
        $this->order = $slideDetails['order'];
        $this->image = $slideDetails['image'];
        $this->editing = $slideDetails['editing'];
    }

    public function submit()
    {
        tenancyFn($this->tenant_id);

        $this->validate([
            'name' => 'required|string|max:255',
            'image_alt' => 'nullable|string',
            'image_link' => 'nullable|string',
            'slide_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:262144',
            //'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:262144',
        ], [
            'name.required' => 'Nome é obrigatório.',
            'image_alt.max' => 'Texto alternativo deve ter no máximo 255 caracteres.',
            'slide_image.required' => 'Imagem é obrigatória.',
            'slide_image.image' => 'O arquivo deve ser uma imagem.',
            'slide_image.mimes' => 'A imagem deve ser um arquivo JPG, JPEG, PNG ou GIF.',
            'slide_image.max' => 'O tamanho máximo permitido para a imagem é 256 KB.',
        ]);

        $status = $this->status ?? 'ativo';

        $newOrder = $this->getNextAvailableOrder();

        // Processar o upload e salvar no banco de dados
        $path = $this->slide_image->store('imgs', 'public');

        $activeSlidesCount = Slides::where('status', 'ativo')->count();

        if ($activeSlidesCount >= 5 && $status == 'ativo') {
            $errorMessage = 'O número máximo de slides ativos é 5.';
            $this->addError('max_slides', $errorMessage);
            session()->flash('error', $errorMessage);
            return;
        }

        Slides::create([
            'name' => $this->name,
            'status' => $status,
            'image_alt' => $this->image_alt,
            'image_link' => $this->image_link,
            'image' => $path,
            'order' => $newOrder,
        ]);

        // Limpar os campos e redirecionar
        session()->flash('message', 'Imagem salva com sucesso.');
        $this->reset();
        return redirect()->route('panel');
    }

    private function getNextAvailableOrder()
    {
        // Obter todos os slides ordenados por ordem ascendente
        $slides = Slides::orderBy('order', 'asc')->get();

        // Definir a nova ordem padrão como 1
        $newOrder = 1;

        // Encontrar a próxima ordem disponível
        foreach ($slides as $slide) {
            // Se a ordem atual estiver ocupada, passar para a próxima
            if ($slide->order == $newOrder) {
                $newOrder++;
            } else {
                // Se encontrar uma ordem disponível, parar o loop
                break;
            }
        }

        return $newOrder;
    }

    public function updateSlide()
    {
        tenancyFn($this->tenant_id);

        $this->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:ativo,inativo',
            'image_alt' => 'nullable|string|max:255',
            'image_link' => 'nullable|string',
            'order' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $totalSlides = Slides::count();
                    if ($value > $totalSlides) {
                        $fail('A ordem deve ser menor ou igual à quantidade total de slides.');
                    }
                },
            ],
        ], [
            'name.required' => 'Nome é obrigatório.',
            'status.required' => 'Status é obrigatório.',
            'status.in' => 'Status deve ser ativo ou inativo.',
            'image_alt.max' => 'Texto alternativo deve ter no máximo 255 caracteres.',
            'order.integer' => 'A ordem deve ser um número inteiro.',
            'order.min' => 'A ordem deve ser maior ou igual a 1.',
        ]);

        $activeSlidesCount = Slides::where('status', 'ativo')->count();

        if ($activeSlidesCount >= 5 && $this->status == 'ativo') {
            $errorMessage = 'O número máximo de slides ativos é 5.';
            $this->addError('max_slides', $errorMessage);
            session()->flash('error', $errorMessage);
            return;
        }

        $slide = Slides::where('image', $this->image)->first();
        if ($slide) {
            $slide->name = $this->name;
            $slide->status = $this->status;
            $slide->image_alt = $this->image_alt;
            $slide->image_link = $this->image_link;

            $this->updateSlideOrder($slide);

            $slide->save();

            session()->flash('message', 'Slide atualizado com sucesso.');
            return redirect()->route('panel');
        } else {
            session()->flash('error', 'Slide não encontrado.');
            return redirect()->route('panel');
        }
    }

    private function updateSlideOrder($slide)
    {
        $currentOrder = $slide->order;
        $newOrder = $this->order;

        // Obter o número total de slides salvos
        $totalSlides = Slides::count();

        // Se a nova ordem exceder o número total de slides, não é uma alteração válida
        if ($newOrder > $totalSlides) {
            session()->flash('error', 'A ordem deve ser alterada dentro do intervalo dos slides salvos.');
            return redirect()->route('panel');
        }

        // Se a ordem atual for diferente da nova ordem
        if ($currentOrder !== $newOrder) {
            // Verificar se a nova ordem é válida
            if ($newOrder >= 1 && $newOrder <= $totalSlides) {
                // Atualizar a ordem do slide
                $slide->order = $newOrder;

                // Atualizar a ordem dos outros slides se necessário
                if ($newOrder < $currentOrder) {
                    // Incrementar a ordem dos slides com ordem maior que a nova ordem
                    Slides::whereBetween('order', [$newOrder, $currentOrder - 1])
                        ->where('id', '!=', $slide->id)
                        ->increment('order');
                } else {
                    // Decrementar a ordem dos slides com ordem menor que a nova ordem
                    Slides::whereBetween('order', [$currentOrder + 1, $newOrder])
                        ->where('id', '!=', $slide->id)
                        ->decrement('order');
                }

                // Salvar o slide atualizado
                $slide->save();
            } else {
                session()->flash('error', 'A ordem deve ser entre 1 e ' . $totalSlides . '.');
                return redirect()->route('panel');
            }
        }
    }


    public function render()
    {
        return view('livewire.admin.slide.create-slide');
    }
}
