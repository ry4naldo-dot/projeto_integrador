<!-- Wrapper centralizado (mesmo estilo do Login) -->
<div class="flex justify-center items-start w-full min-h-[calc(100vh-70px)] bg-gray-50 pt-12 md:pt-20 px-4 pb-12">
    
    <!-- Card de Cadastro -->
    <div class="bg-white w-full max-w-lg p-8 md:p-10 rounded-xl shadow-sm border border-gray-200">
        
        <!-- Cabeçalho / Logo -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight">
                Click<span class="text-blue-600">Vagas</span>
            </h1>
            <p class="text-base text-gray-500 mt-2">Crie sua conta e comece a se candidatar</p>
        </div>

        <!-- Formulário de Cadastro -->
        <form action="/cadastro" method="POST" class="space-y-5">
            
            <!-- Campo Nome Completo -->
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome e sobrenome" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
            </div>

            <!-- Campo E-mail -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="email" id="email" name="email" placeholder="nome@exemplo.com" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
            </div>

            <!-- Divisão para as senhas ficarem lado a lado em telas maiores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Campo Senha -->
                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="••••••••" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
                </div>

                <!-- Campo Confirmar Senha -->
                <div>
                    <label for="senha_confirmacao" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Senha</label>
                    <input type="password" id="senha_confirmacao" name="senha_confirmacao" placeholder="••••••••" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
                </div>
            </div>

            <!-- Termos de uso -->
            <div class="flex items-start mt-2">
                <div class="flex items-center h-5">
                    <input id="termos" name="termos" type="checkbox" required
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                </div>
                <div class="ml-2 text-sm">
                    <label for="termos" class="text-gray-600 cursor-pointer">
                        Eu concordo com os <a href="#" class="text-blue-600 hover:underline">Termos de Serviço</a> e a <a href="#" class="text-blue-600 hover:underline">Política de Privacidade</a>.
                    </label>
                </div>
            </div>

            <!-- Botão de Cadastro -->
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-lg mt-4">
                Criar Conta
            </button>
        </form>

        <!-- Link para Login -->
        <div class="mt-8 text-center text-base text-gray-600">
            Já tem uma conta? 
            <a href="login" class="text-blue-600 hover:text-blue-800 hover:underline font-bold">
                Entrar agora
            </a>
        </div>

    </div>
</div>