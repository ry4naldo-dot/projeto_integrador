<!doctype html>
<html lang="pt-br" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/click.png" type="icon">
    <title>ClickVagas - Oportunidades de Emprego</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans m-0 p-0 overflow-x-hidden flex flex-col min-h-screen">

    <header class="bg-white py-4 lg:py-0 lg:h-[70px] flex flex-col lg:flex-row justify-evenly items-center w-full gap-4 lg:gap-0 shadow-sm border-b border-gray-200">
        
        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900"><button id="toggleBtn" class="hover:text-gray-900 transition">
            Click</button><span class="text-blue-600">Vagas</span>
        </h1>

        <nav class="flex flex-wrap items-center justify-center gap-4 lg:gap-6">
            <a href="index" class="text-gray-600 font-medium transition-colors hover:text-blue-600 no-underline">Início</a>
            <a href="#vagas" class="text-gray-600 font-medium transition-colors hover:text-blue-600 no-underline">Vagas Recentes</a>
            <a href="#empresas" class="text-gray-600 font-medium transition-colors hover:text-blue-600 no-underline">Empresas</a>

            
            <?php 
            // Só mostra a barra cinza e as opções de conta SE:
            // O usuário estiver logado OU a página atual NÃO for a FazerLogin
            if (isset($_SESSION['auth']) || $view !== 'login'): 
            ?>
                <div class="hidden lg:block h-6 w-px bg-gray-300 mx-2"></div>

                <ul class="flex items-center gap-4 m-0 p-0 list-none">
                    <?php if (isset($_SESSION['auth'])): ?>
                        
                        <li>
                            <a href="/logout" class="text-sm text-gray-500 hover:text-red-500 transition-colors font-medium">
                                Sair (<?= htmlspecialchars($_SESSION['auth']->nome) ?>)
                            </a>
                        </li>
                        
                    <?php else: ?>
                        
                        <li>
                            <a href="login" class="bg-blue-600 text-white px-5 py-2 rounded-md font-medium hover:bg-blue-700 transition-colors no-underline">
                                Entrar
                            </a>
                        </li>
                        
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </nav>

        <form action="/buscar" method="GET" class="w-[90%] lg:w-auto">
            <input
                type="text"
                name="pesquisar"
                placeholder="Buscar vagas, cargos..."
                class="py-2 px-4 rounded-md border border-gray-300 w-full lg:w-[250px] text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
            />
        </form>
    </header>

    <main class="flex-1 flex w-full">
        <?php require "view/{$view}.view.php"; ?>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center text-gray-500 text-sm mt-auto w-full">
        &copy; <?= date('Y') ?> ClickVagas. Todos os direitos reservados.
    </footer>

    <script src="/script.js"></script>

</body>
</html>