<div class="w-full max-w-md mx-auto px-4 py-16 flex items-center justify-center min-h-[calc(100vh-200px)]">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 w-full">
        
        <!-- Cabeçalho do Card -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Acesso Empresa</h2>
            <p class="text-sm text-gray-500 mt-2">Faça login para publicar vagas e gerenciar currículos.</p>
        </div>

        <!-- Aqui você pode colocar um alerta de erro em PHP caso o login falhe -->
        <?php if (isset($erro)): ?>
            <div class="mb-6 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-md text-center">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <form action="/processar_login_empresa" method="POST" class="space-y-5">
            
            <!-- E-mail -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail Profissional</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                    placeholder="contato@suaempresa.com.br"
                >
            </div>

            <!-- Senha -->
            <div>
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                    placeholder="••••••••"
                >
            </div>

            <!-- Botão Entrar -->
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-md hover:bg-blue-700 transition-colors focus:ring-4 focus:ring-blue-200 mt-2 text-sm">
                Entrar na Conta
            </button>

        </form>

        <!-- Link para cadastro -->
        <div class="mt-8 text-center text-sm text-gray-500 border-t border-gray-100 pt-6">
            Sua empresa ainda não é parceira? 
            <a href="/cadastro_empresa" class="text-blue-600 hover:text-blue-800 hover:underline font-medium ml-1 transition-colors">
                Cadastre-se aqui
            </a>
        </div>

    </div>
</div>