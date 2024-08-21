<?php

namespace App\Livewire\Site;

use App\Models\Raffle;
use App\Models\Slides;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Welcome extends Component
{

    public $active_raffles;
    public $sorted_raffles;
    public $slides = 2;

    public function mount()
    {
        $this->active_raffles = Cache::remember('active_raffles', now()->addDay(), function () {
            return Raffle::where('status', 'ativa')
                ->where(function ($query) {
                    $query->where(function ($innerQuery) {
                        $innerQuery->whereNull('publication_date')
                            ->orWhere('publication_date', '<', now()->subHours(3)->format('Y-m-d'));
                    })
                    ->orWhere(function ($innerQuery) {
                        $innerQuery->where('publication_date', now()->subHours(3)->format('Y-m-d'))
                            ->where(function ($innerInnerQuery) {
                                $innerInnerQuery->whereNull('publication_hour')
                                    ->orWhere('publication_hour', '<=', now()->subHours(3)->format('H:i'));
                            });
                    });
                })
                ->where('sorted', false)
                ->orderByDesc('publication_date')
                ->get(['name', 'main_photo', 'id', 'price_per_number', 'draw_date', 'draw_hour', 'susep_process'])
                ->toArray();
        });

        $this->sorted_raffles = Cache::remember('sorted_raffles', now()->addDay(), function () {
            return Raffle::where('sorted', true)
                ->orderByDesc('draw_date')
                ->get(['name', 'main_photo', 'id', 'price_per_number', 'draw_date', 'draw_hour', 'susep_process'])
                ->toArray();
        });

        $this->slides = Cache::remember('slides', now()->addDay(), function () {
            return Slides::where('status', 'ativo')
                ->orderBy('order')
                ->limit(5)
                ->get(["name", "image", "order", "status", "image_alt", "image_link"]);
        });
    }


    public function render()
    {
        return view('livewire.site.welcome');
    }
}
