<div class="flex justify-center items-start w-full min-h-screen bg-gray-50 pt-20 md:pt-32 px-4">
    
    <div class="bg-white w-full max-w-lg p-10 rounded-xl shadow-sm border border-gray-200">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold tracking-tight">
                Click<span class="text-blue-600">Vagas</span>
            </h1>
            <p class="text-base text-gray-500 mt-3">Acesse sua conta para encontrar oportunidades</p>
        </div>
        
        <?php
        if ($validacao = flash()->get('validacoes_login')):
            foreach ($validacao as $v):

        ?>
                <h1 class="bg-red-500"><?= $v ?></h1>
        <?php
            endforeach;

        endif;
        ?>

        <form action="/login" method="POST" class="space-y-6">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                <input type="email" id="email" name="email" placeholder="nome@exemplo.com" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
            </div>

            <div>
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-base">
            </div>

            <!-- <div class="flex items-center justify-between text-sm mt-2">
                <label class="flex items-center text-gray-600 cursor-pointer">
                    <input type="checkbox" name="lembrar" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    Lembrar de mim
                </label>
                <a href="/recuperar-senha" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                    Esqueceu a senha?
                </a>
            </div> -->

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-lg mt-2">
                Entrar
            </button>
        </form>

        <div class="mt-8 text-center text-base text-gray-600">
            Ainda não criou uma conta? 
            <a href="cadastrar" class="text-blue-600 hover:text-blue-800 hover:underline font-bold">
                Cadastre-se
            </a>
        </div>

    </div>
</div>