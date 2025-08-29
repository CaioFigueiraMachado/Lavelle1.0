<?php
// Carrinho por usuário logado
session_start();
include('../conexao/conexao.php');
if (!isset($_SESSION['id'])) {
    header('Location: ../conexao/index.php');
    exit;
}
$user_id = $_SESSION['id'];
// Adiciona produto ao carrinho
if (isset($_POST['add']) && isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);
    $qtd = isset($_POST['qtd']) ? intval($_POST['qtd']) : 1;
    $check = $mysqli->query("SELECT * FROM carrinho WHERE usuario_id=$user_id AND produto_id=$produto_id");
    if ($check->num_rows > 0) {
        $mysqli->query("UPDATE carrinho SET quantidade=quantidade+$qtd WHERE usuario_id=$user_id AND produto_id=$produto_id");
    } else {
        $mysqli->query("INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES ($user_id, $produto_id, $qtd)");
    }
    header('Location: paginaprodutos.php?msg=adicionado');
    exit;
}
// Remove produto do carrinho
if (isset($_POST['remove']) && isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);
    $mysqli->query("DELETE FROM carrinho WHERE usuario_id=$user_id AND produto_id=$produto_id");
    header('Location: paginaprodutos.php?msg=removido');
    exit;
}
// Lista produtos do carrinho
$carrinho = $mysqli->query("SELECT c.*, p.nome, p.preco, p.imagem FROM carrinho c JOIN produtos p ON c.produto_id=p.id WHERE c.usuario_id=$user_id");
?>
<h2>Meu Carrinho</h2>
<table border="1" cellpadding="8">
<tr><th>Produto</th><th>Imagem</th><th>Preço</th><th>Qtd</th><th>Ações</th></tr>
<?php while($item = $carrinho->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($item['nome']) ?></td>
    <td><img src="<?= htmlspecialchars($item['imagem']) ?>" width="60"></td>
    <td>R$ <?= number_format($item['preco'],2,',','.') ?></td>
    <td><?= $item['quantidade'] ?></td>
    <td>
        <form method="post" style="display:inline">
            <input type="hidden" name="produto_id" value="<?= $item['produto_id'] ?>">
            <button name="remove">Remover</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>
