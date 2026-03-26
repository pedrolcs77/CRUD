<?php
require __DIR__ . "/User.php";

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$userObj = new User();
$userData = $userObj->findById($_GET['id']);

// Se alguém tentar digitar um ID que não existe na URL, barra aqui
if (!$userData) {
    die("<h2 style='color: white; font-family: sans-serif; text-align: center; margin-top: 50px;'>Registro não encontrado.</h2>");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno - Plataforma Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
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
            background-color: var(--dark-bg);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .matrix-card {
            background-color: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 600px;
        }

        .matrix-card h3 {
            color: var(--matrix-green);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            font-size: 1.5rem;
            text-align: center;
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

        .form-control:focus {
            border-color: var(--matrix-green) !important;
            box-shadow: 0 0 0 0.25rem rgba(32, 194, 14, 0.25) !important;
        }

        .btn-matrix-solid {
            background-color: var(--matrix-green);
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-matrix-solid:hover {
            background-color: var(--matrix-green-hover);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(32, 194, 14, 0.4);
        }

        .btn-matrix-outline {
            color: var(--text-muted);
            border: 1px solid #30363d;
            border-radius: 30px;
            padding: 12px 25px;
            transition: all 0.3s;
            background: transparent;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 100%;
        }
        .btn-matrix-outline:hover {
            border-color: var(--text-light);
            color: var(--text-light);
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="matrix-card">
            <h3><i class="bi bi-pencil-square me-2"></i> Editar Registro</h3>
            
            <form action="update.php" method="post" class="row g-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($userData['id']) ?>">

                <div class="col-12">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($userData['name']) ?>" required>
                </div>
                
                <div class="col-12">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($userData['email']) ?>" required>
                </div>
                
                <div class="col-12">
                    <label class="form-label">Curso</label>
                    <input type="text" name="document" class="form-control" value="<?= htmlspecialchars($userData['document']) ?>" required>
                </div>
                
                <div class="col-md-6 mt-5">
                    <a href="index.php" class="btn btn-matrix-outline"><i class="bi bi-arrow-left me-2"></i> Cancelar</a>
                </div>
                <div class="col-md-6 mt-5">
                    <button type="submit" class="btn btn-matrix-solid"><i class="bi bi-check2-circle me-2"></i> Atualizar Dados</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>