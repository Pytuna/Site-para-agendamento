<?php
$titulo = isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : '';
$local = isset($_GET['local']) ? htmlspecialchars($_GET['local']) : '';
$link = isset($_GET['link']) ? htmlspecialchars($_GET['link']) : '';
$numero = isset($_GET['numero']) ? htmlspecialchars($_GET['numero']) : '';
$descricao = isset($_GET['descricao']) ? htmlspecialchars($_GET['descricao']) : '';
$opcao = isset($_GET['opcao']) ? htmlspecialchars($_GET['opcao']) : '';
$data = isset($_GET['data']) ? htmlspecialchars($_GET['data']) : '';
$inicio = isset($_GET['inicio']) ? htmlspecialchars($_GET['inicio']) : '';
$fim = isset($_GET['fim']) ? htmlspecialchars($_GET['fim']) : '';
$privado = isset($_GET['checkbox']) ? 'Sim' : 'Não';

session_start();
if (!isset($_SESSION['eventos'])) {
  $_SESSION['eventos'] = array();
}

if (!empty($titulo)) {
  $novoEvento = array(
    'titulo' => $titulo,
    'local' => $local,
    'link' => $link,
    'numero' => $numero,
    'descricao' => $descricao,
    'opcao' => $opcao,
    'data' => $data,
    'inicio' => $inicio,
    'fim' => $fim,
    'privado' => $privado
  );
  array_push($_SESSION['eventos'], $novoEvento);
}

if (isset($_GET['sair'])) {
  session_destroy();
  header('Location: form.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Agenda</title>
  <link rel="shortcut icon" href="/Primeira-Avaliacao/src/assets/agendar.png" />
  <!--CSS-->
  <link rel="stylesheet" href="/Primeira-Avaliacao/src/css/style-php.css" />
  <!--Responisvidade-->
  <link rel="stylesheet" href="/Primeira-Avaliacao/includes/icon.css">
  <link type="text/css" rel="stylesheet" href="/Primeira-Avaliacao/includes/materialize.min.css" />
  <!--Fonte-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <header>
    <nav>
      <input type="checkbox" class="checkbox" name="checkbox" id="checkbox">
      <label for="checkbox" class="label-menu">
        Menu<span class="hamburger"></span>
      </label>
      <ul class="lista">
        <li><a href="/Primeira-Avaliacao/index.html">Home</a></li>
        <li><a href="/">Agenda</a></li>
        <li><a href="/">Sobre</a></li>
        <li><a href="/">FAQ</a></li>
      </ul>
    </nav>
  </header>

  <section class="direita">
    <div class="container">
      <h2>Lista de Eventos</h2>
      <div class="card">
        <ul class="lista-eventos">
          <?php
          if (isset($_GET['limpar'])) {
            $_SESSION['eventos'] = array();
          }
          if (isset($_SESSION['eventos']) && count($_SESSION['eventos']) > 0) {
            foreach ($_SESSION['eventos'] as $evento) {
              echo '<li>';
              echo '<strong class="titulO">' . $evento['titulo'] . '</strong>';
              echo '<p>Local: ' . $evento['local'] . '</p>';
              echo '<p>Data: ' . $evento['data'] . ' ' . $evento['inicio'] . ' - ' . $evento['fim'] . '</p>';
              echo '<p>Prioridade: ' . ucfirst($evento['opcao']) . '</p>';
              echo '<p>Privado: ' . $evento['privado'] . '</p>';
              echo '</li>';
            }
          } else {
            echo '<li>Nenhum evento cadastrado ainda.</li>';
          }
          ?>
        </ul>
      </div>
    </div>
    <button>
      <a class="remover" href="?limpar=1">Limpar Eventos</a>
    </button>
  </section>
  </main>
</body>

</html>