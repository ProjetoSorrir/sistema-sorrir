<div>
    @extends('layouts.admin')
    @section('title', 'Documentação')
    @section('content')

    <div class="documentation">
        <h2>Documentação Componentes</h2>
        <div class="component-box">
            <h3>Botão Primário</h3>
            {{-- exemplo do componente --}}
            <div class="component-container">
                <button class="primary-button">
                    Botão
                </button>
                <textarea name="" id="" cols="10" rows="5">
                    {{-- código do componente --}}
                    <button class="primary-button>
                        Botão
                    </button>
                </textarea>
            </div>
        </div>
        <div class="component-box">
            <h3>Inputs</h3>
            <div class="component-container">
                <div class="input-container">
                    <label for="name">Nome da Imagem *</label>
                    <input wire:model="name" type="text" id="name" name="name" placeholder="Nome da Imagem" required>
                </div>
                <textarea name="" id="" cols="10" rows="10">
                    <div class="input-container">
                        <label for="name">Nome da Imagem *</label>
                        <input wire:model="name" type="text" id="name" name="name" placeholder="Nome da Imagem" required>
                    </div>
                </textarea>
            </div>
        </div>
        <div class="component-box">
            <h3>Select</h3>
            <div class="component-container">
                <div class="input-container">
                    <label for="image-order">Ordem</label>
                    <select wire:model="image-order" type="text" id="image-order" name="image-order">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <textarea name="" id="" cols="10" rows="10">
                    <div class="input-container">
                        <label for="image-order">Ordem</label>
                        <select wire:model="image-order" type="text" id="image-order" name="image-order">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </textarea>
            </div>
        </div>
        <div class="component-box">
            <h3>Tabela</h3>
            <div class="component-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Coluna</th>
                            <th>Coluna</th>
                            <th>Coluna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Item</td>
                            <td>Item</td>
                            <td>Item</td>
                        </tr>
                        <tr>
                            <td>Item</td>
                            <td>Item</td>
                            <td>Item</td>
                        </tr>
                        <tr>
                            <td>Item</td>
                            <td>Item</td>
                            <td>Item</td>
                        </tr>
                    </tbody>
                </table>
                <textarea name="" id="" cols="10" rows="10">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Coluna</th>
                                <th>Coluna</th>
                                <th>Coluna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                            <tr>
                                <td>Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                            <tr>
                                <td>Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                        </tbody>
                    </table>
                </textarea>
            </div>
        </div>

    </div>
    <style>
        .documentation {
            gap: 32px;
            margin: 0;
            display: flex;
            padding: 32px;
            flex-direction: column;
            background-color: #FFFBE8;
        }

        .documentation h2 {
            font-weight: 900;
            font-size: 20px;
            text-align: center;
        }
        .component-box {
            width: 50%;
            padding: 32px;
            display: flex;
            border: 1px solid;
            border-radius: 8px;
            flex-direction: column;
            background-color: white;
            margin: 0 auto;
        }

        .component-box h3 {
            text-align: center;
            font-weight: 800;
        }

        .component-container {
            gap: 32px;
            display: flex;
            padding: 32px;
            flex-direction: column;
        }
    </style>


    @endsection
</div>
