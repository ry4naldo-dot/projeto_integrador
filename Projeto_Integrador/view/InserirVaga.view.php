<div class="w-full max-w-3xl mx-auto px-4 py-12">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 sm:p-10">
        
        <!-- Cabeçalho -->
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Publicar Nova Vaga
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Preencha os detalhes abaixo para anunciar uma nova oportunidade na sua empresa.
            </p>
        </div>

        <!-- Alertas -->
        <?php if (isset($sucesso)): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Vaga publicada com sucesso!
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <form action="/processar_inserir_vaga" method="POST" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nome da Empresa -->
                <!-- Dica: Em um sistema real, você pode usar um input hidden com o nome da sessão da empresa logada -->
                <div class="md:col-span-2">
                    <label for="nome_empresa" class="block text-sm font-medium text-gray-700 mb-1">Nome da Empresa *</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required 
                        value="<?= isset($_SESSION['auth']->nome_empresa) ? htmlspecialchars($_SESSION['auth']->nome_empresa) : '' ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm bg-gray-50"
                        placeholder="Ex: ClickVagas Tech">
                </div>

                <!-- Categoria / Tipo (Enum do banco) -->
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Categoria da Vaga *</label>
                    <select id="tipo" name="tipo" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm bg-white appearance-none">
                        <option value="" disabled selected>Selecione uma área...</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="jogos">Jogos</option>
                        <option value="seguranca">Segurança</option>
                        <option value="diversao">Diversão</option>
                        <option value="mercado">Mercado</option>
                        <option value="agronomia">Agronomia</option>
                        <option value="medicina">Medicina</option>
                        <option value="ambiente">Meio Ambiente</option>
                    </select>
                </div>

                <!-- Modelo de Trabalho (Enum do banco) -->
                <div>
                    <label for="modelo" class="block text-sm font-medium text-gray-700 mb-1">Modelo de Trabalho *</label>
                    <select id="modelo" name="modelo" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm bg-white appearance-none">
                        <option value="" disabled selected>Selecione o modelo...</option>
                        <option value="presencial">Presencial</option>
                        <option value="hibrido">Híbrido</option>
                        <option value="remoto">Remoto</option>
                    </select>
                </div>

                <!-- Valor / Salário -->
                <!-- Valor / Salário -->
<div class="md:col-span-2">
    <label for="valor" class="block text-sm font-medium text-gray-700 mb-1">Remuneração (R$) *</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">R$</span>
        </div>
        <input type="number" id="valor" name="valor" step="0.01" min="0" required 
            class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
            placeholder="Ex: 7500.00">
    </div>
    <!-- Aviso adicionado aqui em baixo  -->
    <p class="mt-1 text-xs text-gray-500">
        Digite <span class="font-semibold">0</span> se o salário for "A combinar".
    </p>
</div>

                <!-- Descrição da Vaga -->
                <div class="md:col-span-2">
                    <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição das Atividades e Requisitos *</label>
                    <textarea id="descricao" name="descricao" rows="6" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm resize-none"
                        placeholder="Descreva as responsabilidades, requisitos técnicos, benefícios..."></textarea>
                </div>
            </div>

            <!-- Botão Salvar -->
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors focus:ring-4 focus:ring-blue-200 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Publicar Vaga
                </button>
            </div>

        </form>

    </div>
</div>