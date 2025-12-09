<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine do Pequeno Produtor</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root { --brand-primary: #2d6a4f; --brand-secondary: #40916c; --brand-accent: #e9c46a; --brand-dark: #1b4332; --brand-bg: #f4f7f6; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--brand-bg); color: var(--brand-dark); overflow-x: hidden; }
        
        /* Loading */
        #loader-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.5s ease; }
        .spinner { width: 50px; height: 50px; border: 5px solid rgba(45, 106, 79, 0.2); border-left-color: var(--brand-primary); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .animate-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s forwards; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        /* Hero */
        .hero-section { background: linear-gradient(135deg, rgba(27, 67, 50, 0.85) 0%, rgba(45, 106, 79, 0.7) 100%), url('https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80'); background-size: cover; background-position: center 60%; color: white; padding: 100px 0 120px; margin-bottom: -60px; border-radius: 0 0 50px 50px; box-shadow: 0 10px 30px rgba(45, 106, 79, 0.2); }
        .search-input { border: none; padding: 20px; border-radius: 50px 0 0 50px !important; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .search-btn { border-radius: 0 50px 50px 0 !important; background-color: var(--brand-accent); border: none; color: var(--brand-dark); padding: 0 25px; transition: 0.3s; }
        .search-btn:hover { background-color: #d4b258; transform: translateY(-2px); }
        .btn-brand-accent { background-color: var(--brand-accent); color: var(--brand-dark); border: none; }
        .btn-brand-accent:hover { background-color: #d4b258; color: var(--brand-dark); }
        .filter-pill { background-color: white; color: var(--brand-secondary); border: 1px solid var(--brand-secondary); padding: 8px 20px; transition: 0.3s; }
        .filter-pill:hover, .filter-pill.active { background-color: var(--brand-secondary); color: white; box-shadow: 0 4px 10px rgba(64, 145, 108, 0.3); }

        /* Cards */
        .card { border: none; border-radius: 25px; overflow: hidden; background: white; transition: all 0.4s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: 100%; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(45, 106, 79, 0.15); }
        .card-img-wrap { height: 220px; overflow: hidden; position: relative; }
        .card-img-top { height: 100%; width: 100%; object-fit: cover; transition: transform 0.5s; }
        .card:hover .card-img-top { transform: scale(1.1); }
        .category-badge { position: absolute; top: 15px; right: 15px; background-color: rgba(255,255,255,0.9); color: var(--brand-primary); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.8rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .price-tag { color: var(--brand-primary); font-size: 1.5rem; font-weight: 700; }

        /* Dropdown */
        .dropdown-menu { background-color: var(--brand-accent); border: none; border-radius: 25px; padding: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); left: 50% !important; transform: translateX(-50%) !important; margin-top: 15px; min-width: 240px; text-align: center; }
        .dropdown-menu::before { content: ''; position: absolute; top: -10px; left: 50%; transform: translateX(-50%); border-width: 0 12px 12px 12px; border-style: solid; border-color: transparent transparent var(--brand-accent) transparent; }
        .dropdown-item { color: var(--brand-dark); font-weight: 700; border-radius: 15px; padding: 12px; margin-bottom: 5px; transition: 0.2s; }
        .dropdown-item:hover { background-color: rgba(255, 255, 255, 0.5); color: var(--brand-dark); transform: scale(1.02); }
        .dropdown-divider { border-top: 1px solid rgba(0,0,0,0.1); margin: 10px 0; }
    </style>
</head>
<body>

    <div id="loader-overlay">
        <div class="text-center">
            <div class="spinner mb-3 mx-auto"></div>
            <h6 class="text-muted fw-bold">Carregando Vitrine...</h6>
        </div>
    </div>

    <div class="hero-section text-center animate-up">
        <div class="container position-relative" style="z-index: 2;">
            <h1 class="display-3 fw-bold mb-3">Do Campo para sua Mesa 🌿</h1>
            <p class="lead mb-5 opacity-75 w-75 mx-auto">Conectamos você diretamente aos pequenos produtores da região.</p>
            
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 col-md-9">
                    <form action="index.php" method="GET" class="d-flex">
                        <input type="text" name="busca" class="form-control form-control-lg search-input" placeholder="Buscar produtos..." value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>">
                        <button class="btn btn-lg search-btn" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <?php if(isset($_GET['busca']) && $_GET['busca'] != ''): ?>
                        <div class="mt-3">
                            <span class="text-white-50 me-2">Filtrado por: "<?php echo $_GET['busca']; ?>"</span>
                            <a href="index.php" class="badge bg-danger text-decoration-none py-2 px-3 rounded-pill">Limpar</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if(isset($_SESSION['usuario_id'])): ?>
                <div class="dropdown mt-4 position-relative">
                    <button class="btn btn-brand-accent btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="<?php echo $_SESSION['usuario_foto']; ?>" class="rounded-circle me-2 border border-2 border-dark" width="30" height="30" style="object-fit: cover;">
                        Olá, <?php echo $_SESSION['usuario_nome']; ?>
                    </button>
                    <ul class="dropdown-menu animate slideIn">
                        <li><a class="dropdown-item" href="index.php?acao=dashboard"><i class="bi bi-speedometer2 me-2"></i> Meu Painel</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="confirmarLogout()"><i class="bi bi-box-arrow-right me-2"></i> Sair</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="index.php?acao=login" class="btn btn-brand-accent btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg mt-4">
                    <i class="bi bi-person-circle me-2"></i> Sou Produtor: Entrar
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container pb-5 animate-up delay-200" style="margin-top: 80px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
            <div>
                 <h3 class="fw-bold mb-1 text-brand-dark">Explorar Produtos</h3>
                 <p class="text-muted mb-0"><?php echo count($produtos); ?> itens frescos encontrados</p>
            </div>
            <div class="d-flex gap-2 mt-3 mt-md-0 flex-wrap justify-content-center">
                <a href="index.php" class="btn filter-pill rounded-pill">Todos</a>
                <a href="index.php?busca=Hortifruti" class="btn filter-pill rounded-pill">🥦 Hortifruti</a>
                <a href="index.php?busca=Artesanato" class="btn filter-pill rounded-pill">🧶 Artesanato</a>
                <a href="index.php?busca=Laticínios" class="btn filter-pill rounded-pill">🧀 Laticínios</a>
                <a href="index.php?busca=Doces" class="btn filter-pill rounded-pill">🍯 Doces</a>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($produtos as $item): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-img-wrap">
                        <img src="<?php echo $item['imagem_url']; ?>" class="card-img-top" alt="<?php echo $item['nome']; ?>">
                        <span class="category-badge shadow-sm"><?php echo $item['categoria']; ?></span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title mb-3"><?php echo $item['nome']; ?></h5>
                        <p class="card-text text-muted small flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?php echo $item['descricao']; ?></p>
                        <hr class="text-muted opacity-25 my-3">
                        <div>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Preço/Unidade</small>
                                <span class="price-tag">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
                            </div>
                            <button type="button" class="btn btn-outline-success w-100 py-2 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modalProduto<?php echo $item['id']; ?>">
                                <i class="bi bi-plus-circle me-1"></i> Ver Detalhes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($produtos)): ?>
                <div class="col-12 text-center py-5 my-5">
                    <h3 class="text-muted fw-bold">Poxa, não encontramos nada...</h3>
                    <a href="index.php" class="btn btn-brand-accent rounded-pill px-4 mt-3 fw-bold">Ver todos</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php foreach($produtos as $item): ?>
    <div class="modal fade" id="modalProduto<?php echo $item['id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                <div class="modal-header border-0 bg-light">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="<?php echo $item['imagem_url']; ?>" class="w-100 h-100" style="object-fit: cover; min-height: 300px;">
                        </div>
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge bg-success mb-2"><?php echo $item['categoria']; ?></span>
                                <h3 class="fw-bold text-brand-dark"><?php echo $item['nome']; ?></h3>
                                <h2 class="text-success fw-bold my-3">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></h2>
                                <p class="text-muted"><?php echo $item['descricao']; ?></p>
                            </div>

                            <div class="bg-light p-3 rounded-4 mt-4 border">
                                <h6 class="fw-bold text-muted small mb-3 text-uppercase">Dados do Fornecedor</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?php echo isset($item['foto_vendedor']) ? $item['foto_vendedor'] : 'https://ui-avatars.com/api/?name='.$item['vendedor']; ?>" class="rounded-circle me-3" width="50" height="50">
                                    <div>
                                        <div class="fw-bold"><?php echo isset($item['vendedor']) ? $item['vendedor'] : 'Produtor Local'; ?></div>
                                        <div class="small text-muted"><i class="bi bi-envelope me-1"></i> <?php echo isset($item['email_vendedor']) ? $item['email_vendedor'] : 'Email não informado'; ?></div>
                                        <div class="small text-muted"><i class="bi bi-phone me-1"></i> <?php echo $item['contato']; ?></div>
                                    </div>
                                </div>
                                <a href="https://wa.me/55<?php echo $item['contato']; ?>?text=Olá, vi o anúncio *<?php echo $item['nome']; ?>* na Vitrine Local e tenho interesse!" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold">
                                    <i class="bi bi-whatsapp me-2"></i> Negociar no WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener("load", function() {
            const loader = document.getElementById('loader-overlay');
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 500);
        });

        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href') && !this.getAttribute('href').startsWith('#') && !this.getAttribute('data-bs-toggle')) {
                    document.getElementById('loader-overlay').style.display = 'flex';
                    setTimeout(() => { document.getElementById('loader-overlay').style.opacity = '1'; }, 10);
                }
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');
        if(msg) {
            let config = { icon: 'info', title: 'Aviso', confirmButtonColor: '#2d6a4f' };
            if(msg === 'login_sucesso') { config.icon = 'success'; config.title = 'Bem-vindo de volta!'; config.text = 'Login realizado com sucesso.'; }
            else if(msg === 'erro_login') { config.icon = 'error'; config.title = 'Ops!'; config.text = 'Email ou senha incorretos.'; }
            else if(msg === 'cadastro_sucesso') { config.icon = 'success'; config.title = 'Conta Criada!'; config.text = 'Faça login para continuar.'; }
            else if(msg === 'logout_sucesso') { config.icon = 'success'; config.title = 'Até logo!'; config.text = 'Você saiu do sistema.'; }
            Swal.fire(config).then(() => { window.history.replaceState({}, document.title, window.location.pathname); });
        }

        function confirmarLogout() {
            Swal.fire({ title: 'Sair do sistema?', text: "Você terá que fazer login novamente.", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Sim, sair!', cancelButtonText: 'Cancelar' }).then((result) => {
                if (result.isConfirmed) { window.location.href = 'index.php?acao=logout'; }
            })
        }
    </script>
</body>
</html>