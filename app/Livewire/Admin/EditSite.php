<?php

namespace App\Livewire\Admin;

use App\Models\Settings;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSite extends Component
{
    use WithFileUploads;
    public string $tenant_id;

    public $logo_image;
    public $favicon_image;

    public $logo;
    public $favicon;
    public $site_name;
    public $mercado_pago_token;
    public $instagram;
    public $TikTok;
    public $YouTube;
    public $Telegram;
    public $TelegramGrupo;
    public $WhatsappSuporteSite;
    public $WhatsappGrupo;
    public $twitter;
    public $facebook;
    public $linkedin;
    public $discord;
    public $terms_of_use_accepted;
    public $pixel_facebook;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        $this->logo_image = Settings::get('logo') ?? null;
        $this->favicon_image = Settings::get('favicon') ?? null;
        $this->site_name = Settings::get('site_name') ?? null;
        $this->mercado_pago_token = Settings::get('mercado_pago_token') ?? null;
        $this->instagram = Settings::get('instagram') ?? null;
        $this->TikTok = Settings::get('TikTok') ?? null;
        $this->YouTube = Settings::get('YouTube') ?? null;
        $this->Telegram = Settings::get('Telegram') ?? null;
        $this->TelegramGrupo = Settings::get('TelegramGrupo') ?? null;
        $this->WhatsappSuporteSite = Settings::get('WhatsappSuporteSite') ?? null;
        $this->WhatsappGrupo = Settings::get('WhatsappGrupo') ?? null;
        $this->twitter = Settings::get('twitter') ?? null;
        $this->facebook = Settings::get('facebook') ?? null;
        $this->linkedin = Settings::get('linkedin') ?? null;
        $this->discord = Settings::get('discord') ?? null;
        $this->terms_of_use_accepted = Settings::get('terms_of_use_accepted') ?? null;
        $this->pixel_facebook = Settings::get('pixel_facebook') ?? null;
    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        return view(
            'livewire.admin.edit-site',
        );
    }

    public function submit()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'logo' => 'nullable|image|max:2048', // Máximo de 2 MB para imagens
            'favicon' => 'nullable|image|max:512', // Máximo de 512 KB para favicons
            'site_name' => 'nullable|string|max:255',
            'mercado_pago_token' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]{1,30}\/?$/'],
            'TikTok' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?tiktok\.com\/(@[a-zA-Z0-9._]{2,24}|[a-zA-Z0-9._]{2,24}\/video\/[0-9]{1,})\/?$/'],
            'YouTube' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?youtube\.com\/(c|channel|user|@)?\/?[a-zA-Z0-9_-]{1,}\/?$/'],
            'Telegram' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?t\.me\/[a-zA-Z0-9_]{5,32}\/?$/'],
            'TelegramGrupo' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?t\.me\/joinchat\/[a-zA-Z0-9_]{5,32}\/?$/'],
            'WhatsappSuporteSite' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?wa\.me\/[0-9]{10,15}\/?$/'],
            'WhatsappGrupo' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/chat\.whatsapp\.com\/(?:invite\/)?[a-zA-Z0-9_-]{20,24}\/?$/'],
            'linkedin' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9-]{3,100}\/?$/'],
            'twitter' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?twitter\.com\/[a-zA-Z0-9_]{1,15}\/?$/'],
            'discord' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?discord\.gg\/[a-zA-Z0-9]{2,32}\/?$/'],
            'facebook' => ['nullable', 'string', 'max:255', 'regex:/^https?:\/\/(www\.)?facebook\.com\/[a-zA-Z0-9.]{5,50}\/?$/'],
            'terms_of_use_accepted' => 'nullable|accepted',
            'pixel_facebook' => 'nullable|string|max:255',
        ], [
            'logo.image' => 'O arquivo de logo deve ser uma imagem.',
            'logo.max' => 'O tamanho máximo da imagem de logo é 2 MB.',
            'favicon.image' => 'O arquivo de favicon deve ser uma imagem.',
            'favicon.max' => 'O tamanho máximo da imagem de favicon é 512 KB.',
            'site_name.max' => 'O nome do site não pode ter mais de 255 caracteres.',
            //'mercado_pago_token.regex' => 'O token do Mercado Pago deve começar com "APP_USR-".',
            'instagram.regex' => 'Insira um link válido do Instagram. (Ex: https://www.instagram.com/seu_usuario)',
            'twitter.regex' => 'Insira um link válido do Twitter. (Ex: https://www.twitter.com/seu_usuario)',
            'TikTok.regex' => 'Insira um link válido do TikTok. (Ex: https://www.tiktok.com/@seu_usuario)',
            'YouTube.regex' => 'Insira um link válido do YouTube. (Ex: https://www.youtube.com/seu_canal)',
            'Telegram.regex' => 'Insira um link válido do Telegram. (Ex: https://t.me/seu_canal)',
            'TelegramGrupo.regex' => 'Insira um link válido do Grupo do Telegram. (Ex: https://t.me/joinchat/codigo_do_grupo)',
            'WhatsappSuporteSite.regex' => 'Insira um link válido do Suporte WhatsApp. (Ex: https://wa.me/5511999999999)',
            'WhatsappGrupo.regex' => 'Insira um link válido do Grupo de WhatsApp. (Ex: https://chat.whatsapp.com/codigo_do_grupo)',
            'linkedin.regex' => 'Insira um link válido do LinkedIn. (Ex: https://www.linkedin.com/in/seu_usuario)',
            'discord.regex' => 'Insira um link válido do Canal do Discord. (Ex: https://discord.gg/codigo_do_canal)',
            'facebook.regex' => 'Insira um link válido do Facebook. (Ex: https://www.facebook.com/seu_usuario)',
            'terms_of_use_accepted.accepted' => 'Você deve aceitar os termos de uso.',
            'pixel_facebook.max' => 'O identificador do Pixel do Facebook não pode ter mais de 255 caracteres.',
        ]);

        $settings = Settings::first();

        // Obtenha os valores atuais dos campos de configuração
        $currentSettings = [
            'logo' => Settings::get('logo'),
            'favicon' => Settings::get('favicon'),
            'site_name' => Settings::get('site_name'),
            'mercado_pago_token' => Settings::get('mercado_pago_token'),
            'instagram' => Settings::get('instagram'),
            'TikTok' => Settings::get('TikTok'),
            'YouTube' => Settings::get('YouTube'),
            'Telegram' => Settings::get('Telegram'),
            'WhatsappSuporteSite' => Settings::get('WhatsappSuporteSite'),
            'WhatsappGrupo' => Settings::get('WhatsappGrupo'),
            'twitter' => Settings::get('twitter'),
            'facebook' => Settings::get('facebook'),
            'linkedin' => Settings::get('linkedin'),
            'discord' => Settings::get('discord'),
            'terms_of_use_accepted' => Settings::get('terms_of_use_accepted'),
            'pixel_facebook' => Settings::get('pixel_facebook'),
        ];

        // Apenas atualiza os campos de imagem se foram fornecidos
        if ($this->logo) {
            $pathLogo = $this->logo->store('settings', 'public');
            Settings::set('logo', $pathLogo);
        }

        if ($this->favicon) {
            $pathFavicon = $this->favicon->store('settings', 'public');
            Settings::set('favicon', $pathFavicon);
        }

        // Atualiza os outros campos se eles foram fornecidos
        if (!is_null($this->site_name)) {
            Settings::set('site_name', $this->site_name);
        }
        if (!is_null($this->mercado_pago_token)) {
            Settings::set('mercado_pago_token', $this->mercado_pago_token);
        }
        if (!is_null($this->instagram)) {
            Settings::set('instagram', $this->instagram);
        }
        if (!is_null($this->TikTok)) {
            Settings::set('TikTok', $this->TikTok);
        }
        if (!is_null($this->YouTube)) {
            Settings::set('YouTube', $this->YouTube);
        }
        if (!is_null($this->Telegram)) {
            Settings::set('Telegram', $this->Telegram);
        }
        if (!is_null($this->TelegramGrupo)) {
            Settings::set('TelegramGrupo', $this->TelegramGrupo);
        }
        if (!is_null($this->WhatsappSuporteSite)) {
            Settings::set('WhatsappSuporteSite', $this->WhatsappSuporteSite);
        }
        if (!is_null($this->WhatsappGrupo)) {
            Settings::set('WhatsappGrupo', $this->WhatsappGrupo);
        }
        if (!is_null($this->twitter)) {
            Settings::set('twitter', $this->twitter);
        }
        if (!is_null($this->facebook)) {
            Settings::set('facebook', $this->facebook);
        }
        if (!is_null($this->discord)) {
            Settings::set('discord', $this->discord);
        }
        if (!is_null($this->linkedin)) {
            Settings::set('linkedin', $this->linkedin);
        }
        if (!is_null($this->terms_of_use_accepted)) {
            Settings::set('terms_of_use_accepted', $this->terms_of_use_accepted);
        }
        if (!is_null($this->pixel_facebook)) {
            Settings::set('pixel_facebook', $this->pixel_facebook);
        }

        // Obtenha os novos valores dos campos de configuração após a alteração
        $newSettings = [
            'logo' => Settings::get('logo'),
            'favicon' => Settings::get('favicon'),
            'site_name' => Settings::get('site_name'),
            'mercado_pago_token' => Settings::get('mercado_pago_token'),
            'instagram' => Settings::get('instagram'),
            'TikTok' => Settings::get('TikTok'),
            'YouTube' => Settings::get('YouTube'),
            'Telegram' => Settings::get('Telegram'),
            'TelegramGrupo' => Settings::get('TelegramGrupo'),
            'WhatsappSuporteSite' => Settings::get('WhatsappSuporteSite'),
            'WhatsappGrupo' => Settings::get('WhatsappGrupo'),
            'twitter' => Settings::get('twitter'),
            'facebook' => Settings::get('facebook'),
            'linkedin' => Settings::get('linkedin'),
            'discord' => Settings::get('discord'),
            'terms_of_use_accepted' => Settings::get('terms_of_use_accepted'),
            'pixel_facebook' => Settings::get('pixel_facebook'),
        ];

        // Verifique se houve alterações nos campos
        if ($currentSettings !== $newSettings) {
            // Se houver alterações, envie a flash message
            return redirect()->route('edit-site')->with('message', 'Configurações salvas com sucesso.');
        } else {
            return redirect()->route('edit-site');
        }
    }
    public function removeLogo()
    {
        tenancyFn($this->tenant_id);

        // Remove o arquivo de logo do armazenamento
        $settings = Settings::where('key', 'logo')->first();
        if ($settings && $settings->value) {
            \Storage::delete($settings->value);
            $settings->delete(); // Remove o registro correspondente do banco de dados
            session()->flash('message', 'Logo removida com sucesso.');
        } else {
            session()->flash('error', 'Nenhum logo encontrado para remover.');
        }
        return redirect()->route('edit-site');
    }

    public function removeFavicon()
    {
        tenancyFn($this->tenant_id);

        // Remove o arquivo de favicon do armazenamento
        $settings = Settings::where('key', 'favicon')->first();
        if ($settings && $settings->value) {
            \Storage::delete($settings->value);
            $settings->delete(); // Remove o registro correspondente do banco de dados
            session()->flash('message', 'Favicon removido com sucesso.');
        } else {
            session()->flash('error', 'Nenhum favicon encontrado para remover.');
        }
        return redirect()->route('edit-site');
    }
}
