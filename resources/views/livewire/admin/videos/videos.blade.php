<div class="card card-margins">
    <!-- Título da seção de vídeo -->
    <div class="card__title">Seção de Vídeo</div>

    <!-- Instruções da página -->
    <div class="page-instructions">
        <p>Caso deseje, adicione uma seção de vídeo para compor sua página.</p>
        <p>Selecione um vídeo que esteja hospedado no Youtube e compartilhe o link conosco, para seja exibido na sua
            página.</p>
    </div>

    <div>
        <!-- Formulário para adicionar/editar vídeo -->
        @if (!$video || $editing)
            <form class="space-y-6" wire:submit.prevent="submit">
                @csrf
                <!-- Mensagem de erro, se houver -->
                @if (session()->has('error'))
                    <div class="alert alert-danger text-sm text-red-500">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="lg:w-3/4">
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-4">
                            <!-- Opções de cor de fundo -->
                            <div class="input-container">
                                <label for="backgroudColor">Cor de Fundo</label>
                                <select wire:model="background_color" id="backgroudColor" name="backgroudColor">
                                    <option value="">Selecione a cor</option>
                                    <option value="purple">Roxo</option>
                                    <option value="yellow">Amarelo</option>
                                    <option value="black">Preto</option>
                                    <option value="white">Branco</option>
                                </select>
                            </div>
                            <!-- Opções de cor do texto -->
                            <div class="input-container">
                                <label for="textColor">Selecionar Cor do Texto</label>
                                <select wire:model="text_color" id="textColor" name="textColor">
                                    <option value="">Selecione a cor</option>
                                    <option value="purple">Roxo</option>
                                    <option value="yellow">Amarelo</option>
                                    <option value="white">Branco</option>
                                    <option value="black">Preto</option>
                                </select>
                            </div>
                            <!-- Campo de entrada para o link do vídeo -->
                            <div class="input-container">
                                <label for="videoLink">Link de Incorporação (embed)*</label>
                                <input wire:model="link" type="text" id="videoLink" name="videoLink"
                                    placeholder="https://www.youtube.com/embed/VIDEO_ID">
                                @error('link')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Campo de entrada para o texto -->
                        <div class="input-container">
                            <label for="Texto">Texto</label>
                            <textarea wire:model="text" id="text" name="text" rows="4" placeholder="Digite algo aqui"></textarea>
                        </div>
                        <!-- Botão para salvar as alterações -->
                        @if (!$video)
                            <div class="flex justify-end">
                                <button type="submit" class="primary-button">
                                    Salvar
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        @endif

        <!-- Botão para atualizar o vídeo -->
        @if ($video && $editing)
            <div class="lg:w-3/4  flex justify-end">
                <button wire:click="updateVideo" class="primary-button">Atualizar</button>
            </div>
        @endif
    </div>


    <!-- Renderizar o vídeo -->
    @if ($video)
        <div class="video-container flex w-fit h-full justify-end gap-4">
            <div class="w-full max-w-2xl mx-auto p-4 md:p-6 mt-4"
                style="background-color: {{ $video->background_color }}; color: {{ $video->text_color }}; margin-bottom: 1.5rem;">
                <div class="flex flex-col md:flex-row justify-between items-start mt-4">
                    <div class="w-full md:w-1/2 md:mr-4">
                        <!-- Vídeo incorporado -->
                        <div class="embed-responsive">
                            <iframe width="560" height="250" src="{{ $video->link }}" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <!-- Descrição do vídeo -->
                        <div class="mt-2 mb-8 md:mb-0">
                            <p class="text-base md:text-lg font-semibold">{{ $video->text }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botões de edição/deleção do vídeo -->
            <div class="flex flex-col justify-end items-end gap-4 w-fit pb-6">
                @livewire('admin.videos.edit-button', ['videoId' => $video->id, 'tenantId' => $tenant_id])
                @livewire('admin.videos.delete-button', ['id' => $video->id, 'tenantId' => $tenant_id])
            </div>
        </div>
    @endif
</div>

<!-- Script para carregar detalhes do vídeo -->
<script>
    Livewire.on('videoDetailsLoaded', (videoDetails) => {
        // Carregar detalhes do vídeo
        @this.background_color = videoDetails.background_color;
        @this.text_color = videoDetails.text_color;
        @this.link = videoDetails.link;
        @this.text = videoDetails.text;
    });
</script>
