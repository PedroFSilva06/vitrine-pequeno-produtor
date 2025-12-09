<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login - Vitrine do Produtor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root { --brand-primary: #2d6a4f; --brand-secondary: #40916c; --brand-accent: #e9c46a; --brand-dark: #1b4332; --brand-bg: #f4f7f6; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--brand-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; color: var(--brand-dark); overflow: hidden; }
        
        /* Loading Screen */
        #loader-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.5s ease; }
        .spinner { width: 50px; height: 50px; border: 5px solid rgba(45, 106, 79, 0.2); border-left-color: var(--brand-primary); border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Animations */
        .animate-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s forwards; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        /* Card Styles */
        .card-login { background: white; border-radius: 30px; box-shadow: 0 20px 60px rgba(45, 106, 79, 0.1); overflow: hidden; width: 100%; max-width: 450px; border: none; position: relative; z-index: 1; }
        .login-header { background-color: var(--brand-primary); padding: 40px 30px; text-align: center; color: white; }
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #e0e0e0; background-color: #f8f9fa; transition: 0.3s; }
        .form-control:focus { background-color: white; border-color: var(--brand-secondary); box-shadow: 0 0 0 3px rgba(64, 145, 108, 0.15); }
        .btn-brand { background-color: var(--brand-accent); color: var(--brand-dark); font-weight: 700; border-radius: 12px; padding: 12px; border: none; transition: 0.3s; }
        .btn-brand:hover { background-color: #d4b258; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(233, 196, 106, 0.4); }
        a { color: var(--brand-secondary); text-decoration: none; font-weight: 600; transition: 0.2s; }
        a:hover { color: var(--brand-primary); }
    </style>
</head>
<body>

    <div id="loader-overlay"><div class="spinner"></div></div>

    <div class="card-login animate-up">
        <div class="login-header">
            <h2 class="fw-bold mb-0"><i class="bi bi-flower1"></i> Bem-vindo</h2>
            <p class="mb-0 opacity-75">Acesse seu painel de produtor</p>
        </div>
        <div class="p-5">
            <form action="index.php?acao=logar" method="POST" id="formLogin">
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">SEU EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px;"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" placeholder="exemplo@email.com" style="border-radius: 0 12px 12px 0;" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted">SUA SENHA</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px;"><i class="bi bi-key"></i></span>
                        <input type="password" name="senha" class="form-control border-start-0" placeholder="******" style="border-radius: 0 12px 12px 0;" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-brand btn-lg shadow-sm">ENTRAR AGORA</button>
                </div>
                
                <div class="text-center mt-4">
                    <p class="small text-muted mb-2">Ainda não vende conosco?</p>
                    <a href="index.php?acao=cadastro" class="text-decoration-underline">Criar conta de Produtor</a>
                </div>
                <div class="text-center mt-3 border-top pt-3">
                    <a href="index.php" class="text-muted small"><i class="bi bi-arrow-left"></i> Voltar para a Loja</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Loader logic
        window.addEventListener("load", function() {
            const loader = document.getElementById('loader-overlay');
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 500);
        });

        // Show loader on form submit
        document.getElementById('formLogin').addEventListener('submit', function() {
            document.getElementById('loader-overlay').style.display = 'flex';
            document.getElementById('loader-overlay').style.opacity = '1';
        });

        // Show loader on links
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href') && !this.getAttribute('href').startsWith('#')) {
                    document.getElementById('loader-overlay').style.display = 'flex';
                    setTimeout(() => { document.getElementById('loader-overlay').style.opacity = '1'; }, 10);
                }
            });
        });

        // SweetAlert Messages
        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');

        if(msg === 'erro_login') {
            Swal.fire({ icon: 'error', title: 'Acesso Negado', text: 'Email ou senha incorretos.', confirmButtonColor: '#d33' });
        } else if (msg === 'cadastro_sucesso') {
            Swal.fire({ icon: 'success', title: 'Conta Criada!', text: 'Seu cadastro foi realizado. Faça login para começar.', confirmButtonColor: '#2d6a4f' });
        } else if (msg === 'logout_sucesso') {
            const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
            Toast.fire({ icon: 'success', title: 'Você saiu do sistema' });
        }
        
        // Limpa URL
        if(msg) window.history.replaceState({}, document.title, window.location.pathname);
    </script>
</body>
</html>