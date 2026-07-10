<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
            Empresas Parceiras
        </h2>
        <p class="mt-4 text-lg text-gray-500 max-w-2xl">
            Conheça as empresas que estão contratando através do ClickVagas.
        </p>
    </div>

    <?php if (empty($empresas)): ?>

        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma empresa encontrada</h3>
            <p class="mt-1 text-sm text-gray-500">Ainda não temos empresas cadastradas no sistema.</p>
        </div>
    <?php else: ?>
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($empresas as $empresa): ?>
            
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col hover:shadow-md transition-shadow">
                    
                  
                    <div class="flex justify-between items-start mb-4 gap-2">
                        <h3 class="text-xl font-bold text-gray-900 line-clamp-2">
                            <?= htmlspecialchars($empresa->nome_empresa) ?>
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize whitespace-nowrap">
                            <?= htmlspecialchars($empresa->tipo) ?>
                        </span>
                    </div>

                
                    <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-4">
                        <?= htmlspecialchars($empresa->descricao) ?>
                    </p>

                   
                    <div class="mt-auto space-y-3 pt-4 border-t border-gray-100 text-sm">
                        
                     
                        <div class="flex items-start text-gray-500">
                            <svg class="w-5 h-5 mr-2 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="line-clamp-2"><?= htmlspecialchars($empresa->endereco) ?></span>
                        </div>

                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-2 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span><?= htmlspecialchars($empresa->numero) ?></span>
                        </div>

                        <div class="flex items-center text-gray-500 overflow-hidden">
                            <svg class="w-5 h-5 mr-2 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:<?= htmlspecialchars($empresa->email) ?>" class="hover:text-blue-600 truncate transition-colors">
                                <?= htmlspecialchars($empresa->email) ?>
                            </a>
                        </div>
                        
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</div>