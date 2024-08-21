<div>
    <div class="card card-margins">
        <h2 class="card__title">Carrossel de Imagens</h2>
        <div class="page-instructions">
            <p>Adicione Imagens para compor o carrossel na sua página. </p>
            <p>Consulte na tabela as imagens disponíveis. </p>
            <p>Caso queira sugestões de Imagens, <a
                    href="https://www.canva.com/design/DAFYzKMzux4/NkmBEBfBV2OWBQXP2me_9Q/view?mode=preview#23"
                    target="_blank" class="underline">Clique aqui</a></p>

        </div>
        <!-- Componente para adicionar imagens -->
        <div>
            @livewire('admin.slide.create-slide')
        </div>

        <!-- Tabela para exibir as imagens existentes -->
        <div class="overflow-x-auto mt-4">
            <table class="custom-table w-full">
                <thead>
                    <tr>
                        <th scope="col">Ordem</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slides as $slide)
                        <tr>
                            <!-- Coluna para exibir a ordem -->
                            <td>
                                {{ $slide->order }}
                            </td>
                            <td class="flex justify-center">
                                <img src="{{ asset($slide->image) }}" alt="{{ $slide->name }}"
                                    class="h-20 w-40 object-cover">
                            </td>
                            <td class="max-w-24 text-ellipsis">
                                {{ $slide->name }}
                            </td>
                            <!-- Coluna para exibir o status -->
                            <td class="">
                                <div class="flex justify-center align-center h-full">
                                    @if ($slide->status === 'ativo')
                                        <div
                                            class="status-flag border border-dark-green text-dark-green bg-light-green font-medium rounded-md py-1 px-y w-20">
                                            Ativo
                                        </div>
                                    @else
                                        <div
                                            class="status-flag border border-custom-red text-custom-red bg-red-20 font-medium rounded-md py-1 px-y w-20">
                                            Inativo
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-2">
                                    <!-- Botão para editar o slide -->
                                    @livewire('admin.panels.edit-slide', ['slideId' => $slide->id, 'tenantId' => $tenant_id])
                                    @livewire('admin.panels.delete-button', ['id' => $slide->id, 'tenantId' => $tenant_id])
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- cards exibir imagems mobile --}}
        {{-- <div class="grid grid-cols-12 w-full gap-6 md:invisible lg:invisible">
            @foreach ($slides as $slide)
                <div class="card p-4 mt-4 col-span-12 sm:col-span-12">
                    <div class="mt-2 flex justify-between items-center gap-2">
                        <img src="{{ asset($slide->image) }}" alt="{{ $slide->name }}" class="h-20 w-20 object-cover">
                        <div>
                            @if ($slide->status === 'ativo')
                                <div
                                    class="status-flag border border-dark-green  text-dark-green bg-light-green font-medium rounded-md text-center py-1 px-y w-20">
                                    Ativo
                                </div>
                            @else
                                <div
                                    class="status-flag border border-red text-red bg-red-20 font-medium rounded-md text-center py-1  px-y w-20">
                                    Inativo
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col border mt-2 border-rose-300 gap-2">
                        <!-- Botão para editar o slide -->
                        @livewire('admin.panels.edit-slide', ['slideId' => $slide->id, 'tenantId' => $tenant_id])
                        @livewire('admin.panels.delete-button', ['id' => $slide->id, 'tenantId' => $tenant_id])
                    </div>
                    <div class="flex gap-1">
                        <p class="font-bold">Posição no Carrossel:</p>
                        <p>{{ $slide->order }}</p>
                    </div>
                    <div class="flex gap-1">
                        <p class="font-bold">Nome da Imagem:</p>
                        <p>{{ $slide->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
         --}}
    </div>
