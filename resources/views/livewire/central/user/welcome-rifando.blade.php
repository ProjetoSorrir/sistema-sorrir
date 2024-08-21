<div>
    @if ($step == 1)
        <main class="bg-white h-[calc(100%-40px)]">
            <div class="w-full md:w-1/2 lg:w-1/3 mx-auto p-8">
                <div>
                    <h2 class="text-[40px]">Muito bem!</h2>
                    <h3>Forneça o domínio onde colocaremos seu site:</h3>
                </div>
                <a href="" class="text-sm text-primary font-bold">Ainda não tem domínio? Aprenda como adquirir um
                    clicando aqui</a>
                <form wire:submit.prevent="domainStep" class="flex flex-col gap-6 mt-6">
                    <div class="input-container">
                        <label for="domain">Nome do domínio:</label>
                        <input wire:model.defer="domain" type="text" placeholder="Domínio" required>
                        @error('domain')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button @if ($buttonDisabled) disabled @endif
                            class="primary-button w-full">Confirmar</button>
                    </div>
                </form>
            </div>
        </main>
    @endif

    @if ($step == 2)
        <main class="bg-white h-[calc(100%-40px)]">
            <div class="w-full md:w-1/2 lg:w-1/3 mx-auto p-8">
                <div>
                    <h2 class="text-[40px]">Boas vindas a<span class="font-black text-primary">Brascap!</span>
                    </h2>
                    <h3>Defina a senha que irá usar na nossa plataforma:</h3>
                </div>
                <form wire:submit.prevent="createAdminUser" class="flex flex-col gap-6 mt-6">
                    <div class="input-container">
                        <label for="password">Sua nova senha:</label>
                        <input wire:model.defer="password" id="password" name="password" type="password"
                            autocomplete="new-password" placeholder="Escolha uma senha segura (mínimo 8 caracteres)"
                            required>
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            <ul class="mt-1 text-sm text-gray-500 list-disc list-inside">
                                <li>A senha deve ter pelo menos 8 caracteres.</li>
                                <li>A senha deve conter pelo menos uma letra maiúscula.</li>
                                <li>A senha deve conter pelo menos um número.</li>
                                <li>A senha deve conter pelo menos um caractere especial.</li>
                            </ul>
                        @enderror
                    </div>
                    <div class="input-container">
                        <label for="password_confirmation">Confirme sua senha:</label>
                        <input wire:model.defer="password_confirmation" id="password_confirmation"
                            name="password_confirmation" type="password" placeholder="Confirme a senha"
                            autocomplete="new-password" required>
                    </div>
                    <div>
                        <button type="submit" class="primary-button w-full">Redefinir Senha</button>
                    </div>
                </form>
            </div>
        </main>
    @endif

    @if ($step == 3)
        <main class="bg-white h-[calc(100%-40px)] pb-12">
            <div
                class="w-full md:w-1/2 lg:w-1/3 mx-auto p-2 pb-8 flex flex-col justify-center items-center text-primary font-bold">
                <img src="/assets/images/misc/Loading.png" alt="">
                <h2 class="text-2xl mt-[-190px]">Aguarde... </h2>
                @if ($subDomains != '')
                    <h2 class="text-2xl"> Enquanto isso você pode começar a trabalhar no seu site pelo seu dominio
                        provisorio <a href="http://{{ $subDomains }}" target="_blank">{{ $subDomains }}</a>.</h2>
                @endif
                <h2 class="text-2xl"> Estamos vinculando seu site e seu administrador.</h2>

                <p>Inserir Ns no seu dominio</p>

                <p>ns1.rifando-dns.com</p>
                <p>ns2.rifando-dns.com</p>
                <p>ns3.rifando-dns.com</p>
                <p>ns4.rifando-dns.com</p>
            </div>
        </main>
    @endif

    @if ($step == 4)
        <main class="bg-white h-[calc(100%-40px)] pb-12">
            <div
                class="w-full md:w-1/2 lg:w-1/2 mx-auto p-2 pb-8 flex flex-col justify-center items-center text-primary font-bold">
                <img src="/assets/images/misc/Done.png" alt="">
                <h2 class="text-2xl mt-[-120px]">Pronto! </h2>
                <h2 class="text-xl"> Sua nova experiência está pronta! </h2>
                <h2 class="text-xl"> Acesse agora e comece a aproveitar. </h2>
                <a class="primary-button mt-12" href="http://{{ $domain }}" target="_blank">Ir para seu
                    administrador</a>
            </div>
        </main>
    @endif
</div>
