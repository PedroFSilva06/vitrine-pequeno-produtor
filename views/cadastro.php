<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro - Vitrine do Produtor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root { --brand-primary: #2d6a4f; --brand-secondary: #40916c; --brand-accent: #e9c46a; --brand-dark: #1b4332; --brand-bg: #f4f7f6; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--brand-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; color: var(--brand-dark); padding: 20px; overflow-x: hidden; }
        .card-login { background: white; border-radius: 30px; box-shadow: 0 20px 60px rgba(45, 106, 79, 0.1); overflow: hidden; width: 100%; max-width: 500px; border: none; }
        .login-header { background-color: var(--brand-secondary); padding: 30px; text-align: center; color: white; }
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #e0e0e0; transition: 0.3s; }
        .form-control:focus { border-color: var(--brand-primary); box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.15); }
        .btn-brand { background-color: var(--brand-primary); color: white; font-weight: 700; border-radius: 12px; padding: 12px; border: none; transition: 0.3s; }
        .btn-brand:hover { background-color: var(--brand-dark); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(45, 106, 79, 0.3); }
        a { color: var(--brand-secondary); text-decoration: none; font-weight: 600; }
        .animate-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s forwards; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        /* Loader */
        #loader-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.5s ease; }
        .spinner { width: 50px; height: 50px; border: 5px solid rgba(45, 106, 79, 0.2); border-left-color: var(--brand-primary); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="loader-overlay"><div class="spinner"></div></div>

    <div class="card-login animate-up">
        <div class="login-header">
            <h3 class="fw-bold mb-0">Junte-se a nós! 🌿</h3>
            <p class="mb-0 opacity-75">Crie sua conta e comece a vender</p>
        </div>
        <div class="p-4 p-md-5">
            <form action="index.php?acao=salvar_usuario" method="POST" id="formCadastro">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">NOME COMPLETO</label>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome ou da sua fazenda" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">SEU WHATSAPP</label>
                    <input type="text" name="whatsapp" class="form-control" placeholder="DDD + Número" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">EMAIL</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">SENHA</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">FOTO DE PERFIL (URL)</label>
                    <input type="text" name="foto" class="form-control" placeholder="https://...">
                </div>
                
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-brand btn-lg shadow-sm">CRIAR MINHA CONTA</button>
                </div>
                
                <div class="text-center mt-4">
                    <p class="small text-muted mb-2">Já tem cadastro?</p>
                    <a href="index.php?acao=login">Fazer Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener("load", function() {
            const loader = document.getElementById('loader-overlay');
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 500);
        });
        document.getElementById('formCadastro').addEventListener('submit', function() {
            document.getElementById('loader-overlay').style.display = 'flex';
            document.getElementById('loader-overlay').style.opacity = '1';
        });
        
        // SweetAlert
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('msg') === 'erro_cadastro') {
            Swal.fire({ icon: 'error', title: 'Erro', text: 'Email já cadastrado ou erro no sistema.', confirmButtonColor: '#d33' });
        }
        if(urlParams.get('msg')) window.history.replaceState({}, document.title, window.location.pathname);
    </script>
</body>
</html>