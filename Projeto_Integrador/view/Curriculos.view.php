<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Cabeçalho da Página -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                Currículos Recebidos
            </h2>
            <p class="mt-2 text-lg text-gray-500">
                Gerencie os candidatos que aplicaram para as suas vagas.
            </p>
        </div>
    </div>

    <?php if (empty($curriculo)): ?>
        <!-- Mensagem caso não tenha nenhum currículo -->
        <div class="bg-white rounded-lg border border-gray-200 p-12 text-center shadow-sm">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhum candidato ainda</h3>
            <p class="mt-2 text-base text-gray-500">Quando as pessoas se candidatarem às suas vagas, elas aparecerão aqui.</p>
        </div>
    <?php else: ?>
        
        <!-- Grid de Candidatos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <?php foreach ($curriculo as $c): ?>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col">
                    
                    <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <?= htmlspecialchars($c->nome) ?>
                            </h3>
                            
                            <!-- Formata a data de nascimento para o padrão brasileiro -->
                            <p class="text-sm text-gray-500 mt-1">
                                Nascido(a) em: <?= date('d/m/Y', strtotime($c->data_nascimento)) ?>
                            </p>
                        </div>
                        
                        <!-- Tag com a área de interesse -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 uppercase tracking-wide">
                            <?= htmlspecialchars($c->tipo) ?>
                        </span>
                    </div>

                    <!-- Carta de Apresentação / Descrição -->
                    <div class="mb-6 flex-grow">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Carta de Apresentação</h4>
                        <p class="text-gray-700 text-sm bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <?= (($c->descricao)) ?>
                        </p>
                    </div>

                    <!-- Contatos e Ações -->
                    <div class="mt-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <div class="space-y-2">
                            <!-- E-mail -->
                            <a href="mailto:<?= htmlspecialchars($c->email) ?>" class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <?= htmlspecialchars($c->email) ?>
                            </a>
                            
                            <!-- WhatsApp / Telefone -->
                            <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $c->telefone) ?>" target="_blank" class="flex items-center text-sm text-gray-600 hover:text-green-600 transition-colors">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <?= htmlspecialchars($c->telefone) ?>
                            </a>
                        </div>

                        <div class="flex items-end justify-end">
                            <?php if (!empty($c->img)): ?>
                                <!-- Botão de Baixar Currículo (Arquivo Anexado) -->
                                <a href="/<?= htmlspecialchars($c->img) ?>" target="_blank" download class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 text-blue-700 rounded-md hover:bg-blue-600 hover:text-white transition-colors text-sm font-medium w-full md:w-auto justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Ver Anexo
                                </a>
                            <?php else: ?>
                                <span class="text-sm text-gray-400 italic">Sem anexo</span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</div>