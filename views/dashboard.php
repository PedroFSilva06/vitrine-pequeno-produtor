<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Área do Produtor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root { --brand-primary: #2d6a4f; --brand-secondary: #40916c; --brand-accent: #e9c46a; --brand-dark: #1b4332; --brand-bg: #f4f7f6; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--brand-bg); color: var(--brand-dark); }
        
        #loader-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.5s ease; }
        .spinner { width: 50px; height: 50px; border: 5px solid rgba(45, 106, 79, 0.2); border-left-color: var(--brand-primary); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .animate-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s forwards; }
        .delay-200 { animation-delay: 0.2s; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        .navbar-brand-custom { background-color: var(--brand-primary); box-shadow: 0 4px 15px rgba(45, 106, 79, 0.2); }
        .card-custom { border: none; border-radius: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: white; overflow: hidden; }
        .profile-header { background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-secondary) 100%); color: white; padding: 30px; border-radius: 25px 25px 0 0; }
        .btn-accent { background-color: var(--brand-accent); color: var(--brand-dark); font-weight: 700; border-radius: 12px; border: none; }
        .btn-accent:hover { background-color: #d4b258; color: var(--brand-dark); }
        .form-control, .form-select { border-radius: 12px; padding: 12px; border: 1px solid #e0e0e0; }
        .form-control:focus { border-color: var(--brand-secondary); box-shadow: 0 0 0 3px rgba(64, 145, 108, 0.2); }
    </style>
</head>
<body>

    <div id="loader-overlay"><div class="spinner"></div></div>

    <nav class="navbar navbar-dark navbar-brand-custom py-3 animate-up">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-shop-window me-2"></i> Vitrine Local</a>
            <div class="d-flex align-items-center">
                <button onclick="confirmarLogout()" class="btn btn-outline-light rounded-pill px-4 btn-sm">Sair da Conta</button>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5 animate-up delay-200">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-custom h-100">
                    <div class="profile-header text-center">
                        <img src="<?php echo $_SESSION['usuario_foto']; ?>" class="rounded-circle mb-3 border border-4 border-white shadow" width="120" height="120" style="object-fit: cover;">
                        <h4 class="fw-bold mb-0"><?php echo $_SESSION['usuario_nome']; ?></h4>
                        <span class="badge bg-warning text-dark mt-2 rounded-pill px-3">Produtor Verificado</span>
                    </div>
                    <div class="p-4">
                        <div class="d-grid gap-3">
                            <div class="bg-light p-3 rounded-4 border text-center">
                                <h2 class="fw-bold text-success mb-0"><?php echo count($meusProdutos); ?></h2>
                                <small class="text-muted fw-bold text-uppercase">Produtos Ativos</small>
                            </div>
                            <button class="btn btn-accent btn-lg w-100 py-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNovo"><i class="bi bi-plus-circle-dotted me-2"></i> Novo Anúncio</button>
                            <a href="index.php" class="btn btn-outline-secondary w-100 rounded-4 py-2"><i class="bi bi-eye me-2"></i> Ver Loja Pública</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card-custom p-4 h-100">
                    <div class="row align-items-center mb-4 g-3">
                        <div class="col-md-6"><h4 class="fw-bold text-brand-dark mb-0"><i class="bi bi-box-seam me-2"></i> Meus Produtos</h4></div>
                        <div class="col-md-6">
                            <form action="index.php" method="GET" class="d-flex">
                                <input type="hidden" name="acao" value="dashboard">
                                <input type="text" name="busca" class="form-control me-2" placeholder="Pesquisar produto..." value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>">
                                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <?php if(empty($meusProdutos)): ?>
                        <div class="text-center py-5 bg-light rounded-4 border border-dashed">
                            <i class="bi bi-basket display-1 text-muted opacity-25"></i>
                            <h5 class="mt-3 text-muted">Sua banca está vazia!</h5>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="text-muted small text-uppercase">
                                    <tr><th style="width: 80px;">Foto</th><th>Produto</th><th>Preço</th><th class="text-end">Ações</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach($meusProdutos as $p): ?>
                                    <tr>
                                        <td><img src="<?php echo $p['imagem_url']; ?>" width="60" height="60" class="rounded-3 object-fit-cover"></td>
                                        <td><div class="fw-bold text-brand-dark"><?php echo $p['nome']; ?></div><small class="text-muted"><?php echo $p['categoria']; ?></small></td>
                                        <td class="fw-bold text-success">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-warning rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $p['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button onclick="confirmarExclusao(<?php echo $p['id']; ?>)" class="btn btn-sm btn-outline-danger rounded-3"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php foreach($meusProdutos as $p): ?>
    <div class="modal fade" id="modalEditar<?php echo $p['id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
                <div class="modal-header bg-warning text-dark p-4"><h5 class="modal-title fw-bold">Editar Produto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body p-4 bg-light text-start">
                    <form action="index.php?acao=editar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                        <div class="mb-3"><label class="small fw-bold text-muted">NOME</label><input type="text" name="nome" class="form-control" value="<?php echo $p['nome']; ?>" required></div>
                        <div class="mb-3"><label class="small fw-bold text-muted">DESCRIÇÃO</label><textarea name="descricao" class="form-control" rows="2" required><?php echo $p['descricao']; ?></textarea></div>
                        <div class="row">
                            <div class="col-6 mb-3"><label class="small fw-bold text-muted">PREÇO</label><input type="number" step="0.01" name="preco" class="form-control" value="<?php echo $p['preco']; ?>" required></div>
                            <div class="col-6 mb-3"><label class="small fw-bold text-muted">CATEGORIA</label><select name="categoria" class="form-select">
                                <option <?php echo ($p['categoria'] == 'Hortifruti') ? 'selected' : ''; ?>>Hortifruti</option>
                                <option <?php echo ($p['categoria'] == 'Artesanato') ? 'selected' : ''; ?>>Artesanato</option>
                                <option <?php echo ($p['categoria'] == 'Laticínios') ? 'selected' : ''; ?>>Laticínios</option>
                                <option <?php echo ($p['categoria'] == 'Doces') ? 'selected' : ''; ?>>Doces</option>
                                <option <?php echo ($p['categoria'] == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                            </select></div>
                        </div>
                        <div class="mb-3"><label class="small fw-bold text-muted">IMAGEM</label><input type="text" name="imagem_url" class="form-control" value="<?php echo $p['imagem_url']; ?>" required></div>
                        <div class="alert alert-info py-2 small"><i class="bi bi-info-circle me-1"></i> O WhatsApp usado será o do seu perfil.</div>
                        <div class="d-grid mt-4"><button type="submit" class="btn btn-warning fw-bold py-3 shadow-sm">Salvar Alterações</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="modal fade" id="modalNovo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
                <div class="modal-header text-white p-4" style="background-color: var(--brand-primary);"><h5 class="modal-title fw-bold">Novo Item</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                <div class="modal-body p-5 bg-light">
                    <form action="index.php?acao=salvar" method="POST">
                        <div class="row g-3">
                            <div class="col-md-12"><label class="fw-bold small text-muted">NOME</label><input type="text" name="nome" class="form-control" required></div>
                            <div class="col-md-12"><label class="fw-bold small text-muted">DESCRIÇÃO</label><textarea name="descricao" class="form-control" rows="2" required></textarea></div>
                            <div class="col-md-6"><label class="fw-bold small text-muted">PREÇO</label><input type="number" step="0.01" name="preco" class="form-control" required></div>
                            <div class="col-md-6"><label class="fw-bold small text-muted">CATEGORIA</label><select name="categoria" class="form-select"><option>Hortifruti</option><option>Artesanato</option><option>Laticínios</option><option>Doces</option><option>Outros</option></select></div>
                            <div class="col-md-12"><label class="fw-bold small text-muted">IMAGEM URL</label><input type="text" name="imagem_url" class="form-control" placeholder="https://..." required></div>
                        </div>
                        <div class="alert alert-success mt-3 py-2 small"><i class="bi bi-whatsapp me-1"></i> O produto será vinculado ao WhatsApp do seu perfil automaticamente.</div>
                        <div class="d-grid mt-4"><button type="submit" class="btn btn-accent btn-lg py-3 shadow-sm">Salvar Produto</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        function confirmarLogout() {
            Swal.fire({ title: 'Sair?', text: "Você precisará logar de novo.", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Sair' }).then((result) => {
                if (result.isConfirmed) window.location.href = 'index.php?acao=logout';
            })
        }
        function confirmarExclusao(id) {
            Swal.fire({ title: 'Tem certeza?', text: "Isso não pode ser desfeito!", icon: 'error', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Sim, apagar!' }).then((result) => {
                if (result.isConfirmed) window.location.href = 'index.php?acao=excluir&id=' + id;
            })
        }
    </script>
</body>
</html>