<?php
/**
 * Incluímos a classe User para utilizar o padrão de Orientação a Objetos.
 */
require __DIR__ . "/User.php";

$userObj = new User();
$users = $userObj->all();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Alunos - Plataforma Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* ==========================================
           CORES E FONTES GERAIS
           ========================================== */
        :root {
            --matrix-green: #20c20e;
            --matrix-green-hover: #179609;
            --dark-bg: #141a21;
            --card-bg: #1a232c;
            --text-light: #e6edf3;
            --text-muted: #8b949e;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-color: var(--dark-bg);
        }

        /* ==========================================
           SEÇÃO TOPO (CLARA)
           ========================================== */
        .hero-section {
            background-color: #ffffff;
            padding: 60px 0 0 0;
            position: relative;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #111;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-text {
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-matrix-solid {
            background-color: var(--matrix-green);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(32, 194, 14, 0.4);
        }
        .btn-matrix-solid:hover {
            background-color: var(--matrix-green-hover);
            color: #fff;
            transform: translateY(-2px);
        }

        .hero-image {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .hero-graphic {
            position: absolute;
            right: 0;
            top: 20%;
            opacity: 0.6;
            z-index: 1;
            width: 50%;
            pointer-events: none; /* Deixa clicar através do fundo */
        }

        /* ==========================================
           ONDA DE TRANSIÇÃO (SVG)
           ========================================== */
        .wave-transition {
            background-color: #ffffff;
            line-height: 0;
            position: relative;
            z-index: 1;
            pointer-events: none;
        }
        .wave-transition svg {
            display: block;
            width: 100%;
            height: auto;
        }

        /* ==========================================
           SEÇÃO INFERIOR (ESCURA - CRUD)
           ========================================== */
        .crud-section {
            background-color: var(--dark-bg);
            color: var(--text-light);
            padding-bottom: 80px;
            position: relative;
            z-index: 10;
        }

        .matrix-card {
            background-color: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            margin-bottom: 40px;
        }

        .matrix-card h3 {
            color: var(--matrix-green);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
            font-size: 1.4rem;
        }

        .form-label {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-control {
            background-color: var(--dark-bg) !important;
            border: 1px solid #30363d !important;
            color: var(--text-light) !important;
            border-radius: 8px;
            padding: 12px;
        }
        .form-control::placeholder {
            color: var(--text-muted) !important;
        }
        .form-control:focus {
            border-color: var(--matrix-green) !important;
            box-shadow: 0 0 0 0.25rem rgba(32, 194, 14, 0.25) !important;
        }

        .table {
            color: var(--text-light);
            border-color: #30363d;
        }
        .table td, .table th {
            background-color: transparent !important;
            color: var(--text-light) !important;
            border-bottom: 1px solid #30363d;
        }
        .table thead th {
            color: var(--matrix-green) !important;
            border-bottom: 2px solid #30363d;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .btn-matrix-outline {
            color: var(--matrix-green);
            border: 1px solid var(--matrix-green);
            border-radius: 20px;
            padding: 5px 15px;
            transition: all 0.3s;
            background: transparent;
            text-decoration: none;
            display: inline-block;
        }
        .btn-matrix-outline:hover {
            background-color: var(--matrix-green);
            color: #fff;
        }

        /* ==========================================
           CHATBOT FLUTUANTE E CTA
           ========================================== */
        #chat-widget-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--matrix-green);
            color: white;
            border: none;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(32, 194, 14, 0.4);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .chat-cta {
            position: fixed;
            bottom: 40px;
            right: 105px;
            background-color: var(--card-bg);
            color: var(--matrix-green);
            border: 1px solid var(--matrix-green);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 999;
            animation: pulseCta 2s infinite;
            pointer-events: none; 
        }
        .chat-cta::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -6px;
            transform: translateY(-50%);
            border-width: 5px 0 5px 6px;
            border-style: solid;
            border-color: transparent transparent transparent var(--matrix-green);
        }

        @keyframes pulseCta {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        #chat-widget-window {
            position: fixed;
            bottom: 100px; 
            right: 30px;
            width: 350px;
            height: 500px;
            max-height: 80vh;
            z-index: 999;
            display: none;
            flex-direction: column;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            border-radius: 16px;
            overflow: hidden;
            background-color: #fff;
        }
        
        #chat-widget-window.open {
            display: flex;
            animation: slideInUp 0.3s ease;
        }

        @keyframes slideInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        #chat-historico {
            flex: 1;
            overflow-y: auto;
            background-color: #f8f9fa;
            padding: 15px;
            color: #333;
        }
    </style>
</head>

<body>

    <section class="hero-section">
        <img src="https://www.transparenttextures.com/patterns/cubes.png" class="hero-graphic" alt="" style="filter: opacity(0.2) drop-shadow(0 0 10px #20c20e);">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 z-3">
                    <span style="color: var(--matrix-green); font-weight: bold; letter-spacing: 2px;">SECURE.DATA_SYSTEM</span>
                    <h1 class="hero-title mt-2">Gestão de Alunos<br>Web Platform</h1>
                    <p class="hero-text mt-3">Sistema centralizado para cadastro, consulta e gerenciamento de dados acadêmicos com arquitetura segura em PHP e banco de dados relacional.</p>
                    <a href="#cadastro-form" class="btn btn-matrix-solid mt-2">Cadastrar Aluno</a>
                </div>
                
                <div class="col-lg-6 text-center position-relative mt-5 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=800&auto=format&fit=crop" class="hero-image" alt="Tech Background" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <div class="wave-transition">
        <svg viewBox="0 0 1440 200" preserveAspectRatio="none">
            <path fill="#141a21" fill-opacity="1" d="M0,96L80,112C160,128,320,160,480,149.3C640,139,800,85,960,85.3C1120,85,1280,139,1360,165.3L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
    </div>

    <section class="crud-section" id="cadastro-form">
        <div class="container">
            
            <div class="matrix-card">
                <h3>Cadastrar Novo Aluno</h3>
                <form action="store.php" method="post" class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="name" class="form-control" placeholder="Digite o nome do aluno" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="aluno@email.com" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Curso</label>
                        <input type="text" name="document" class="form-control" placeholder="Ex: Gestão de TI" required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-matrix-solid px-5">Salvar Registro</button>
                    </div>
                </form>
            </div>

            <div class="matrix-card">
                <h3>Alunos Matriculados</h3>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Curso</th>
                                <th>Cadastrado em</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td class="text-center fw-bold text-white"><?= $user["id"] ?></td>
                                    <td><?= htmlspecialchars($user["name"]) ?></td>
                                    <td><?= htmlspecialchars($user["email"]) ?></td>
                                    <td><?= htmlspecialchars($user["document"]) ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($user["created_at"])) ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $user["id"] ?>" class="btn btn-matrix-outline btn-sm me-2">Editar</a>
                                        <a href="javascript:void(0);" 
                                           class="btn btn-matrix-outline btn-sm" 
                                           style="color: #ff4d4d; border-color: #ff4d4d;" 
                                           onclick="confirmarExclusao('delete.php?id=<?= $user['id'] ?>', '<?= htmlspecialchars($user['name'], ENT_QUOTES) ?>')">
                                           Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($users) === 0): ?>
                                <tr><td colspan="6" class="text-center text-muted py-5">Nenhum aluno cadastrado no momento.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <div id="chat-cta" class="chat-cta">
        Precisa de ajuda?
    </div>

    <div id="chat-wrapper" style="position: fixed; bottom: 0; right: 0; width: 400px; height: 600px; z-index: 998; pointer-events: none;">
        <button id="chat-widget-button" style="pointer-events: auto;">
            <i class="bi bi-robot fs-3"></i>
        </button>

        <div id="chat-widget-window" style="pointer-events: auto;">
            <div class="p-3 d-flex justify-content-between align-items-center" style="background-color: var(--dark-bg); color: white;">
                <h6 class="mb-0 fw-bold" style="color: var(--matrix-green);">
                    <i class="bi bi-robot me-2"></i> Assistente Virtual
                </h6>
                <button type="button" class="btn-close btn-close-white" id="close-chat" aria-label="Close"></button>
            </div>

            <div id="chat-historico">
                <div class="d-flex justify-content-start mb-3">
                    <div class="p-2 px-3 rounded" style="background-color: #e9ecef; max-width: 85%;">
                        <strong>Assistente:</strong><br>
                        Olá! Sou o assistente virtual. Como posso te guiar pelo sistema hoje?
                    </div>
                </div>
            </div>

            <div class="p-3 bg-white border-top">
                <div class="input-group">
                    <input type="text" id="chat-input" class="form-control" style="background-color: white !important; color: black !important; border-color: #ccc !important;" placeholder="Digite sua dúvida..." onkeypress="if(event.key === 'Enter') enviarMensagem()">
                    <button class="btn btn-matrix-solid rounded-end" style="border-radius: 0 8px 8px 0;" onclick="enviarMensagem()"><i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ==========================================
        // LÓGICA DO SWEETALERT2 (EXCLUSÃO)
        // ==========================================
        function confirmarExclusao(urlDestino, nomeAluno) {
            Swal.fire({
                title: 'Excluir Registro?',
                html: `Você está prestes a apagar permanentemente os dados de <strong>${nomeAluno}</strong>.<br>Esta ação não pode ser desfeita.`,
                icon: 'warning',
                background: '#1a232c', 
                color: '#e6edf3', 
                iconColor: '#ff4d4d', 
                showCancelButton: true,
                confirmButtonColor: '#ff4d4d',
                cancelButtonColor: '#30363d', 
                confirmButtonText: '<i class="bi bi-trash"></i> Sim, Excluir',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'border border-danger', 
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlDestino;
                }
            });
        }

        // ==========================================
        // LÓGICA DO CHATBOT
        // ==========================================
        const chatButton = document.getElementById('chat-widget-button');
        const chatWindow = document.getElementById('chat-widget-window');
        const chatWrapper = document.getElementById('chat-wrapper');
        const cta = document.getElementById('chat-cta');
        const closeBtn = document.getElementById('close-chat');

        chatButton.addEventListener('mouseenter', () => {
            chatWindow.classList.add('open');
            cta.style.display = 'none'; 
            chatWrapper.style.pointerEvents = 'auto'; 
        });

        closeBtn.addEventListener('click', () => {
            chatWindow.classList.remove('open');
            cta.style.display = 'block';
            chatWrapper.style.pointerEvents = 'none';
        });

        async function enviarMensagem() {
            const input = document.getElementById('chat-input');
            const historico = document.getElementById('chat-historico');
            const mensagem = input.value.trim();

            if (!mensagem) return;

            historico.innerHTML += `
                <div class="d-flex justify-content-end mb-3">
                    <div class="p-2 px-3 rounded text-white" style="background-color: var(--matrix-green); max-width: 85%;">
                        ${mensagem}
                    </div>
                </div>`;
            input.value = ''; 
            historico.scrollTop = historico.scrollHeight;

            const loadingId = 'loading-' + Date.now();
            historico.innerHTML += `
                <div id="${loadingId}" class="d-flex justify-content-start mb-3">
                    <div class="p-2 px-3 rounded text-muted" style="background-color: #e9ecef; font-style: italic;">Processando...</div>
                </div>`;
            historico.scrollTop = historico.scrollHeight;

            try {
                const response = await fetch('api/chat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ mensagem: mensagem })
                });
                
                if (!response.ok) throw new Error('Falha no servidor');
                
                const data = await response.json();
                document.getElementById(loadingId).remove();
                
                const respostaIA = data.resposta || data.response || data.message || "Sem formato reconhecido.";
                historico.innerHTML += `
                    <div class="d-flex justify-content-start mb-3">
                        <div class="p-2 px-3 rounded" style="background-color: #e9ecef; max-width: 85%;">
                            <strong>Assistente:</strong><br>${respostaIA}
                        </div>
                    </div>`;
                historico.scrollTop = historico.scrollHeight;

            } catch (error) {
                document.getElementById(loadingId).remove();
                historico.innerHTML += `
                    <div class="text-center mb-3">
                        <span class="badge bg-danger">Erro de conexão API.</span>
                    </div>`;
            }
        }
    </script>
</body>
</html>