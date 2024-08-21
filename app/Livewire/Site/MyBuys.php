<?php

namespace App\Livewire\Site;

use App\Models\Invoice;
use Livewire\Component;
//use Livewire\WithPagination;

class MyBuys extends Component
{
    //use WithPagination;

    public function mount()
    {
        tenancyFn(getTenantId());
    }

    public function render()
    {
        return view('livewire.site.my-buys', [
            'invoices' => Invoice::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(50),
        ]);
    }
}
