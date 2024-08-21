<?php

namespace App\Livewire\Admin\Faq;

use App\Models\Faq;
use Livewire\Component;

class FaqTable extends Component
{
    public string $tenant_id;
    public $newQuestion = '';
    public $newAnswer = '';
    public $search = '';
    public $currentFaqId = null;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
    }


    public function submit()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'newQuestion' => 'required|string',
            'newAnswer' => 'required|string',
        ], [
            'newQuestion.required' => 'O campo pergunta é obrigatório.',
            'newAnswer.required' => 'O campo resposta é obrigatório.'
        ]);

        if ($this->currentFaqId) {
            $faq = Faq::find($this->currentFaqId);
            $faq->update([
                'question' => $this->newQuestion,
                'answer' => $this->newAnswer,
            ]);
            session()->flash('message', 'FAQ atualizado com sucesso.');
        } else {
            Faq::create([
                'question' => $this->newQuestion,
                'answer' => $this->newAnswer,
                'active' => true, // ou baseado em alguma lógica específica
            ]);
            session()->flash('message', 'FAQ criado com sucesso.');
        }

        $this->reset('newQuestion', 'newAnswer', 'currentFaqId');
        return redirect()->route('faq');
    }


    public function editFaq($faqId)
    {
        tenancyFn($this->tenant_id);
        $faq = Faq::findOrFail($faqId);
        $this->newQuestion = $faq->question;
        $this->newAnswer = $faq->answer;
        $this->currentFaqId = $faq->id;
    }

    public function deleteFaq($faqId)
    {
        tenancyFn($this->tenant_id);
        $faq = Faq::findOrFail($faqId);
        $faq->delete();
        // Opção para adicionar uma mensagem de sessão ou emitir um evento Livewire para notificação
        session()->flash('message', 'FAQ deletado com sucesso.');
        return redirect()->route('faq');
    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        return view('livewire.admin.faq.faq-table', [
            'faqs' => Faq::search($this->search)->paginate(10)
        ]);
    }
}
