<!-- Container Principal -->
<main class="max-w-4xl mx-auto p-6 lg:py-12">

    <!-- Botão de Voltar -->
    <a href="/" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition-colors font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Voltar para a lista
    </a>

    <!-- Card da Vaga -->
    <article class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">

        <!-- Cabeçalho -->
        <div class="border-b border-gray-100 pb-6 mb-6">
            <!-- Nome da empresa -->
            <p class="text-blue-600 font-bold uppercase text-sm tracking-wide mb-2"><?= ($vagas->nome_empresa) ?></p>

            <!-- Badges de Informações -->
            <div class="flex flex-wrap gap-3">
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                    Modelo: <?= ($vagas->modelo) ?>
                </span>
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                    Área: <?= ($vagas->tipo) ?>
                </span>
                <?php if ($vagas->valor == 0): ?>
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-bold">
                        A combinar
                    </span>
                <?php else: ?>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                        R$ <?= number_format($vagas->valor, 2, ',', '.'); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Descrição -->
        <div class="prose max-w-none text-gray-700">
            <h2 class="text-xl font-bold text-gray-900 mb-3">Sobre a oportunidade</h2>
            <div class="leading-relaxed">
                <?= ($vagas->descricao) ?>
            </div>
        </div>

        <!-- Botão de Ação -->
        <?php
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']->nome)):
        ?>
            <div class="mt-10 pt-8 border-t border-gray-100">
                <a href="/Candidatar?id=<?= $vagas->id ?>" class="inline-block text-center w-full lg:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg transition-all text-lg shadow-lg shadow-blue-200">
                    Candidatar-se agora
                </a>
            </div>
        <?php endif; ?>

    </article>
</main>