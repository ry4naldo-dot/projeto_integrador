<!-- Wrapper centralizado -->
<div class="flex justify-center items-start w-full min-h-[calc(100vh-70px)] bg-gray-50 pt-12 md:pt-16 px-4 pb-12">
    
    <!-- Card de Candidatura (Um pouco mais largo que o de login para acomodar os campos) -->
    <div class="bg-white w-full max-w-2xl p-8 md:p-10 rounded-xl shadow-sm border border-gray-200">
        
        <!-- Botão de Voltar -->
        <a href="javascript:history.back()" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition-colors font-medium text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Voltar para a vaga
        </a>

        <!-- Cabeçalho -->
        <div class="mb-8 border-b border-gray-100 pb-6">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Candidate-se à Vaga
            </h1>
            <p class="text-base text-gray-500 mt-2">Preencha seus dados para enviar sua candidatura.</p>
        </div>

        <!-- Formulário de Candidatura -->
        <!-- O enctype="multipart/form-data" é OBRIGATÓRIO para o upload do campo "img" -->
        <form action="Candidatar" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="id_vagas" value="<?= $_REQUEST['id'] ?? '' ?>">
            <!-- Campo Nome Completo -->
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
                <input type="text" id="nome" name="nome" placeholder="Como deseja ser chamado(a)" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
            </div>

            <!-- Linha dividida: E-mail e Telefone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="nome@exemplo.com" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
                </div>

                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone / WhatsApp</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
                </div>
            </div>

            <!-- Linha dividida: Data de Nascimento e Tipo/Área -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base text-gray-700">
                </div>

                <div>
                    <!-- Campo Tipo baseado no seu ENUM -->
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Área de Interesse (Tipo)</label>
                    <select id="tipo" name="tipo" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base bg-white">
                        <option value="" disabled selected>Selecione uma área...</option>
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="jogos">Jogos</option>
                        <option value="seguranca">Segurança</option>
                        <option value="diversao">Diversão</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="mercado">Mercado</option>
                        <option value="agronomia">Agronomia</option>
                        <option value="medicina">Medicina</option>
                        <option value="ambiental">Ambiental</option>
                    </select>
                </div>
            </div>

            <!-- Campo Imagem / Currículo (img) -->
            <div>
                <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Anexar Currículo ou Foto (Opcional)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-colors bg-gray-50">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="img" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 p-1">
                                <span>Faça o upload de um arquivo</span>
                                <input id="img" name="img" type="file" class="sr-only" accept="image/*,.pdf,.doc,.docx">
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, PDF ou DOC até 5MB</p>
                    </div>
                </div>
            </div>

            <!-- Campo Descrição / Apresentação -->
            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Carta de Apresentação / Sobre você</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Fale um pouco sobre suas experiências, expectativas e por que você é ideal para a vaga..." required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base resize-y"></textarea>
            </div>

            <!-- Botão de Envio -->
            <div class="pt-4 border-t border-gray-100">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-lg shadow-md">
                    Enviar Candidatura
                </button>
            </div>
        </form>

    </div>
</div>