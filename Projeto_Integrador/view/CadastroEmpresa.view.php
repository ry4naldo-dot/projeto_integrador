<div class="w-full max-w-3xl mx-auto px-4 py-12">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 sm:p-10">
        
        <!-- Cabeçalho -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Cadastro de Empresa
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Junte-se ao ClickVagas e encontre os melhores talentos para a sua equipe.
            </p>
        </div>

        <!-- Alerta de Erro (se houver) -->
        <?php
        if ($validacao = flash()->get('validacoes_registro')):
            foreach ($validacao as $v):

        ?>
                <h1 class="bg-red-500"><?= $v ?></h1>
        <?php
            endforeach;

        endif;
        ?>

        <!-- Formulário -->
        <form action="/CadastroEmpresa" method="POST" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome da Empresa -->
                <div class="md:col-span-2">
                    <label for="nome_empresa" class="block text-sm font-medium text-gray-700 mb-1">Nome da Empresa (Razão Social ou Fantasia) *</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="Ex: Tech Solutions LTDA">
                </div>

                <!-- E-mail -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail Profissional *</label>
                    <input type="email" id="email" name="email" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="contato@empresa.com.br">
                </div>

                <!-- Senha -->
                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha de Acesso *</label>
                    <input type="password" id="senha" name="senha" required minlength="6"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="Mínimo de 6 caracteres">
                </div>

                <!-- Tipo / Ramo de Atuação -->
                <div class="md:col-span-2">
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Ramo de Atuação *</label>
                    <input type="text" id="tipo" name="tipo" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="Ex: Tecnologia, Varejo, Alimentação...">
                </div>

                <!-- Endereço -->
                <div class="md: col-span-2">
                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-1">Endereço (Rua/Avenida) *</label>
                    <input type="text" id="endereco" name="endereco" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                        placeholder="Ex: Rua das Flores">
                </div>

                <!-- Descrição -->
                <div class="md:col-span-2">
                    <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Sobre a Empresa</label>
                    <textarea id="descricao" name="descricao" rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm resize-none"
                        placeholder="Conte um pouco sobre a cultura e os objetivos da empresa..."></textarea>
                </div>
            </div>

            <!-- Botão Salvar -->
            <div class="pt-4">
                <button type="submit" 
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition-colors focus:ring-4 focus:ring-blue-200 text-sm">
                    Finalizar Cadastro
                </button>
            </div>

        </form>

        <!-- Link Voltar -->
        <div class="mt-8 text-center text-sm text-gray-500">
            Já possui cadastro? 
            <a href="LoginEmpresa" class="text-blue-600 hover:text-blue-800 hover:underline font-medium ml-1 transition-colors">
                Faça login aqui
            </a>
        </div>

    </div>
</div>