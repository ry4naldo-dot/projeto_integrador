<!-- Container principal dividido em 3 colunas -->
<div class="flex flex-col  lg:flex-row w-full min-h-[calc(100vh-70px)] bg-gray-100">

    <!-- BARRA BRANCA ESQUERDA (Filtros) -->
    <aside class="hidden lg:block w-[280px] bg-white border-r border-gray-200 p-6 shrink-0">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Filtrar Vagas</h2>

        <form action="/" method="GET" class="space-y-4">

            <input type="hidden" name="pesquisar" value="<?= ($_GET['pesquisar'] ?? '') ?>">

            <div>
                <label for="modelo" class="block text-sm font-medium text-gray-600 mb-1">Modelo de Trabalho</label>
                <select id="modelo" name="modelo" class="w-full border border-gray-300 rounded p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Qualquer</option>
                    <option value="remoto" <?= ($_GET['modelo'] ?? '') === 'remoto' ? 'selected' : '' ?>>Home Office / Remoto</option>
                    <option value="presencial" <?= ($_GET['modelo'] ?? '') === 'presencial' ? 'selected' : '' ?>>Presencial</option>
                    <option value="hibrido" <?= ($_GET['modelo'] ?? '') === 'hibrido' ? 'selected' : '' ?>>Híbrido</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 font-bold py-2 rounded transition-colors text-sm">
                Aplicar Filtros
            </button>
        </form>
    </aside>

    <!-- CONTEÚDO CENTRAL (Lista de Vagas) -->
    <section class="flex-1 p-4 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Vagas Recentes</h2>

            <span class="text-sm text-gray-500">
                <?php if (count($VagasRecentes) == 0): ?>
                    Nenhuma vaga encontrada
                <?php elseif (count($VagasRecentes) == 1): ?>
                    Mostrando 1 vaga disponível
                <?php else: ?>
                    Mostrando <?= count($VagasRecentes) ?> vagas disponíveis
                <?php endif; ?>
            </span>
        </div>

        <!-- Grid de Vagas -->
        <div class="flex flex-col gap-4">

            <!-- Exemplo de card com banco 1 -->
            <?php foreach ($VagasRecentes as $vr): ?>
                <a href="/Vaga?id=<?= $vr->id ?>" class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md hover:border-blue-300 transition-all curspr-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold text-blue-600 mb-1"><?= $vr->nome_empresa ?></h3>
                            <p class="text-sm text-gray-600 font-medium"><?= $vr->endereco ?></p>
                        </div>

                        <?php if ($vr->valor == 0): ?>
                            <span class="bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">
                                A combinar
                            </span>
                        <?php else: ?>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                R$ <?= number_format($vr->valor, 2, ',', '.'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-sm text-gray-500 mt-3 mb-4 line-clamp-2">
                        <?= $vr->descricao ?>
                    </p>
                    <div class="flex items-center gap-3 text-sm text-gray-500">
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg><?= $vr->modelo ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- BARRA BRANCA DIREITA (Destaques/Empresas) -->
    <!-- <aside class="hidden lg:block w-[280px] bg-white border-l border-gray-200 p-6 shrink-0">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Empresas Contratando</h2>

        <div class="space-y-4">
            <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
                <div class="w-10 h-10 bg-blue-100 rounded text-blue-600 flex justify-center items-center font-bold">TS</div>
                <div>
                    <h4 class="font-bold text-sm text-gray-800">TechSolutions</h4>
                    <p class="text-xs text-gray-500">5 vagas abertas</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
                <div class="w-10 h-10 bg-red-100 rounded text-red-600 flex justify-center items-center font-bold">RS</div>
                <div>
                    <h4 class="font-bold text-sm text-gray-800">Rede Supermercados</h4>
                    <p class="text-xs text-gray-500">12 vagas abertas</p>
                </div>
            </div>
        </div>

        <div class="mt-8 p-4 bg-blue-50 border border-blue-100 rounded-lg">
            <h4 class="font-bold text-blue-800 text-sm mb-2">Dica de Ouro</h4>
            <p class="text-xs text-blue-600 leading-relaxed">
                Mantenha seu currículo sempre atualizado. Candidatos com informações recentes têm 3x mais chances de serem chamados.
            </p>
        </div>
    </aside> -->

    <aside class="hidden lg:block w-[280px] bg-white border-l border-gray-200 p-6 shrink-0">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Empresas Contratando</h2>

        <?php foreach ($VagasRecentes as $vr): ?>

            <div class="space-y-4">
                <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded text-blue-600 flex justify-center items-center font-bold">TS</div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-800">TechSolutions</h4>
                        <p class="text-xs text-gray-500">5 vagas abertas</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
                    <div class="w-10 h-10 bg-red-100 rounded text-red-600 flex justify-center items-center font-bold">RS</div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-800">Rede Supermercados</h4>
                        <p class="text-xs text-gray-500">12 vagas abertas</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                <h4 class="font-bold text-blue-800 text-sm mb-2">Dica de Ouro</h4>
                <p class="text-xs text-blue-600 leading-relaxed">
                    Mantenha seu currículo sempre atualizado. Candidatos com informações recentes têm 3x mais chances de serem chamados.
                </p>
            </div>
    </aside>
<?php endforeach; ?>

</div>