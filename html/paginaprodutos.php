<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essence - Nossos Produtos</title>
    <style>
        .cta-button {
            background: #8b4b8c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.4s both;
            text-decoration: none;
        }

        .cta-button:hover {
            background: #6d3a6e;
            transform: translateY(-2px);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            line-height: 1.6;
            color: #333;
            background-color: #fefefe;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #8b4b8c;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #8b4b8c;
        }

        .search-cart {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 0.5rem 1rem;
            border: 2px solid #e8ddd4;
            border-radius: 25px;
            outline: none;
            width: 200px;
            transition: border-color 0.3s ease;
        }

        .search-box input:focus {
            border-color: #8b4b8c;
        }

        .cart-icon {
            position: relative;
            background: #8b4b8c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .cart-icon:hover {
            background: #6d3a6e;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff6b6b;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            padding: 2rem 0;
            text-align: center;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Products Section */
        .products {
            padding: 4rem 0;
            background: #fafafa;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1.5rem;
            border: 2px solid #8b4b8c;
            background: white;
            color: #8b4b8c;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #8b4b8c;
            color: white;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: auto;
            background: none;
            border-radius: 0;
            display: block;
            margin-bottom: 1rem;
            cursor: pointer;
        }

        .favorite-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #ccc;
            transition: color 0.3s ease;
        }

        .favorite-btn.active {
            color: #ff6b6b;
        }

        .product-info h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        .product-info h3:hover {
            color: #8b4b8c;
        }

        .product-info p {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .stars {
            color: #ffd700;
        }

        .add-to-cart {
            width: 100%;
            background: #8b4b8c;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .add-to-cart:hover {
            background: #6d3a6e;
        }

        .view-details {
            width: 100%;
            background: transparent;
            color: #8b4b8c;
            border: 2px solid #8b4b8c;
            padding: 0.8rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-details:hover {
            background: #8b4b8c;
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 2% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e8ddd4;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #8b4b8c;
        }

        .submit-btn {
            width: 100%;
            background: #8b4b8c;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #6d3a6e;
        }

        /* Cart Items */
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .quantity-btn {
            background: #8b4b8c;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
        }

        .cart-total {
            text-align: center;
            padding: 2rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #8b4b8c;
        }

        /* Product Details Modal */
        .product-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .product-details-image {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #8b4b8c;
        }

        .product-details-info h2 {
            color: #8b4b8c;
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .product-details-price {
            font-size: 2rem;
            font-weight: bold;
            color: #8b4b8c;
            margin: 1rem 0;
        }
        h1 {
            font-size: 3rem;
            color: #8b4b8c;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }
        p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease 0.2s both;
        }
            @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .product-details-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .product-features {
            background: #f8f4f0;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            flex-direction: row;
        }

        .product-features h4 {
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        .product-features ul {
            list-style: none;
            padding: 0;
        }

        .product-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e8ddd4;
        }

        .product-features li:last-child {
            border-bottom: none;
        }

        .reviews-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e8ddd4;
        }

        .review-item {
            background: #f8f4f0;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .reviewer-name {
            font-weight: bold;
            color: #8b4b8c;
        }

        .review-stars {
            color: #ffd700;
        }

        /* Footer */
        
 footer {
            background: #333;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #8b4b8c;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #555;
            color: #ccc;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .search-box input {
                width: 150px;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .product-details {
                grid-template-columns: 1fr;
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 1rem 2rem;
            border-radius: 5px;
            z-index: 3000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
    <style>
    .click-flash {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(139, 75, 140, 0.15);
        pointer-events: none;
        z-index: 9999;
        animation: flashAnim 0.4s ease;
    }
    @keyframes flashAnim {
        0% { opacity: 0.7; }
        100% { opacity: 0; }
    }
    </style>
</head>
<body>
<script>
// ...existing code...
</script>
    <!-- Header -->
    <header>
        <nav class="container">
            <a href="index.php" class="logo">Lavelle</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#" style="color: #8b4b8c;">Nossos Produtos</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
            <div class="search-cart">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Buscar perfumes...">
                </div>
                <button class="cart-icon" onclick="openCart()">
                    Carrinho
                    <span class="cart-count" id="cartCount">0</span>
                </button>
                <?php if(isset($_SESSION['id'])): ?>
                <?php else: ?>
                    <a class="cta-button" href="../conexao/login.php">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Nossos Produtos</h1>
            <p>Descubra nossa coleção exclusiva de fragrâncias premium</p>
        </div>
    </section>

    <!-- Products -->
    <section class="products">
        <div class="container">
            <div class="filters">
                <button class="filter-btn active" onclick="filterProducts('todos')">Todos</button>
                <button class="filter-btn" onclick="filterProducts('masculino')">Masculino</button>
                <button class="filter-btn" onclick="filterProducts('feminino')">Feminino</button>
                <button class="filter-btn" onclick="sortProducts('price')">Menor Preço</button>
                <button class="filter-btn" onclick="sortProducts('rating')">Mais Avaliados</button>
            </div>
<?php
include('../conexao/conexao.php');
function escape($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
$result = $mysqli->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = [];
while($prod = $result->fetch_assoc()) {
    $prod['imagens'] = array_map('trim', explode(',', $prod['imagem']));
    $produtos[] = $prod;
}
?>
<div class="product-grid" id="productGrid">
<?php foreach($produtos as $prod): ?>
    <div class="product-card" data-id="<?= escape($prod['id']) ?>">
        <div class="product-images" style="position:relative;">
            <?php foreach($prod['imagens'] as $i => $img): ?>
                <img src="<?= escape($img) ?>" alt="<?= escape($prod['nome']) ?>" style="width:100%;max-width:180px;border-radius:12px;<?= $i > 0 ? 'display:none;' : '' ?>">
            <?php endforeach; ?>
            <?php if(count($prod['imagens']) > 1): ?>
                <button onclick="prevImage(<?= escape($prod['id']) ?>)" style="position:absolute;left:0;top:50%;transform:translateY(-50%);">&#8592;</button>
                <button onclick="nextImage(<?= escape($prod['id']) ?>)" style="position:absolute;right:0;top:50%;transform:translateY(-50%);">&#8594;</button>
            <?php endif; ?>
        </div>
        <h3 onclick="showProductDetails(<?= escape($prod['id']) ?>)"><?= escape($prod['nome']) ?></h3>
        <p><?= escape($prod['descricao']) ?></p>
        <div class="product-price">R$ <?= number_format($prod['preco'], 2, ',', '.') ?></div>
        <form method="post" action="carrinho.php" style="margin-bottom:8px;" onsubmit="event.preventDefault(); fetch('carrinho.php', {method: 'POST', body: new FormData(this)}).then(() => { document.getElementById('cartModal').style.display = 'block'; atualizarCarrinhoModal(); });">
            <input type="hidden" name="produto_id" value="<?= escape($prod['id']) ?>">
            <input type="hidden" name="add" value="1">
            <input type="hidden" name="qtd" value="1">
            <button class="add-to-cart">Adicionar ao Carrinho</button>
        </form>
        <button class="view-details" onclick="showProductDetails(<?= escape($prod['id']) ?>)">Ver Detalhes</button>
    </div>
<?php endforeach; ?>
</div>
<script>
window.produtosDB = <?= json_encode($produtos) ?>;
function prevImage(id) {
    const card = document.querySelector('.product-card[data-id="'+id+'"]');
    const imgs = card.querySelectorAll('.product-images img');
    let current = Array.from(imgs).findIndex(img => img.style.display !== 'none');
    imgs[current].style.display = 'none';
    current = (current - 1 + imgs.length) % imgs.length;
    imgs[current].style.display = 'block';
}
function nextImage(id) {
    const card = document.querySelector('.product-card[data-id="'+id+'"]');
    const imgs = card.querySelectorAll('.product-images img');
    let current = Array.from(imgs).findIndex(img => img.style.display !== 'none');
    imgs[current].style.display = 'none';
    current = (current + 1) % imgs.length;
    imgs[current].style.display = 'block';
}
function showProductDetails(id) {
    const prod = window.produtosDB.find(p => p.id == id);
    if (!prod) return;
    const modal = document.getElementById('productModal');
    const details = document.getElementById('productDetailsContent');
    let imgsHtml = '';
    prod.imagens.forEach((img, i) => {
        imgsHtml += `<img src="${img}" style="width:100%;max-width:300px;border-radius:12px;display:${i===0?'block':'none'};margin-bottom:8px;">`;
    });
    details.innerHTML = `
        <div style='text-align:center;position:relative;'>${imgsHtml}
            ${prod.imagens.length > 1 ? `<button onclick='prevImageModal(${prod.id})' style='position:absolute;left:10px;top:50%;transform:translateY(-50%);'>←</button><button onclick='nextImageModal(${prod.id})' style='position:absolute;right:10px;top:50%;transform:translateY(-50%);'>→</button>` : ''}
        </div>
        <h2>${escapeHtml(prod.nome)}</h2>
        <p>${escapeHtml(prod.descricao)}</p>
        <div class='product-price'>R$ ${parseFloat(prod.preco).toFixed(2).replace('.', ',')}</div>
        <button class='add-to-cart' onclick='addToCart(${prod.id})'>Adicionar ao Carrinho</button>
    `;
    modal.style.display = 'block';
}
function escapeHtml(text) {
    var map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
function prevImageModal(id) {
    const details = document.getElementById('productDetailsContent');
    const imgs = details.querySelectorAll('img');
    let current = Array.from(imgs).findIndex(img => img.style.display !== 'none');
    imgs[current].style.display = 'none';
    current = (current - 1 + imgs.length) % imgs.length;
    imgs[current].style.display = 'block';
}
function nextImageModal(id) {
    const details = document.getElementById('productDetailsContent');
    const imgs = details.querySelectorAll('img');
    let current = Array.from(imgs).findIndex(img => img.style.display !== 'none');
    imgs[current].style.display = 'none';
    current = (current + 1) % imgs.length;
    imgs[current].style.display = 'block';
}
function closeProductDetails() {
    document.getElementById('productModal').style.display = 'none';
}
function updateCartCount() {
    document.getElementById('cartCount').textContent = cart.reduce((total, item) => total + item.quantity, 0);
}
document.addEventListener('DOMContentLoaded', updateCartCount);
// Busca
function filterProducts(cat) {
    let filtered = cat === 'todos' ? window.produtosDB : window.produtosDB.filter(p => p.categoria === cat);
    document.querySelector('.product-grid').innerHTML = '';
    filtered.forEach(prod => {
        // ...renderização igual ao foreach PHP, pode ser melhorado para JS puro se quiser busca instantânea...
    });
}
// Busca por nome
const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', function() {
    const val = this.value.toLowerCase();
    let filtered = window.produtosDB.filter(p => p.nome.toLowerCase().includes(val));
    document.querySelector('.product-grid').innerHTML = '';
    filtered.forEach(prod => {
        // ...renderização igual ao foreach PHP...
    });
});
</script>
    <!-- Footer -->
    

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLogin()">&times;</span>
            <h2>Login / Registro</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" id="userName" required>
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" id="userEmail" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" id="userPassword" required>
                </div>
                <button type="submit" class="submit-btn">Entrar / Registrar</button>
            </form>
        </div>
    </div>

    <!-- Cart Modal -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCart()">&times;</span>
            <h2>Meu Carrinho</h2>
            <?php
            if (isset($_SESSION['id'])) {
                include('../login com database/conexao.php');
                $user_id = $_SESSION['id'];
                $carrinho = $mysqli->query("SELECT c.*, p.nome, p.preco, p.imagem FROM carrinho c JOIN produtos p ON c.produto_id=p.id WHERE c.usuario_id=$user_id");
            ?>
            <table border="1" cellpadding="8" style="width:100%;margin-bottom:2rem;">
            <tr><th>Produto</th><th>Imagem</th><th>Preço</th><th>Qtd</th><th>Ações</th></tr>
            <?php while($item = $carrinho->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td><img src="<?= htmlspecialchars($item['imagem']) ?>" width="60"></td>
                <td>R$ <?= number_format($item['preco'],2,',','.') ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td>
                    <form method="post" action="carrinho.php" style="display:inline">
                        <input type="hidden" name="produto_id" value="<?= $item['produto_id'] ?>">
                        <button name="remove">Remover</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            </table>
            <?php } else { ?>
            <p>Faça login para visualizar seu carrinho.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Product Details Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeProductDetails()">&times;</span>
            <div id="productDetailsContent">
                <!-- Product details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div id="checkoutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCheckout()">&times;</span>
            <h2>Finalizar Compra - DEMO</h2>
            <p style="color: #ff6b6b; text-align: center; margin-bottom: 1rem;">
                ATENÇÃO: Este é um formulário de demonstração. Nenhum pagamento real será processado.
            </p>
            <form id="checkoutForm">
                // ...scripts do carrinho removidos para integração com banco...
            } else {
                cart.push({ ...product, quantity: 1 });
            }

            updateCartCount();
            showNotification('Produto adicionado ao carrinho!');
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartCount();
            displayCartItems();
        }

        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    updateCartCount();
                    displayCartItems();
                }
            }
        }

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        // Atualiza a função displayCartItems para garantir que os itens do carrinho são exibidos corretamente
function displayCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';
    if (!cart || cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>O carrinho está vazio.</p>';
        return;
    }
    cart.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'cart-item';
        itemDiv.innerHTML = `
            <span>${item.nome}</span>
            <span>Qtd: ${item.quantity}</span>
            <span>R$ ${item.preco}</span>
        `;
        cartItemsContainer.appendChild(itemDiv);
    });
}

        function displayCartItems() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            
            if (cart.length === 0) {
                cartItems.innerHTML = '<p style="text-align: center; padding: 2rem;">Seu carrinho está vazio</p>';
                cartTotal.textContent = 'Total: R$ 0,00';
                return;
            }

            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                total += item.price * item.quantity;
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <div class="cart-item-info">
                        <h4>${item.name}</h4>
                        <p>R$ ${item.price.toFixed(2).replace('.', ',')}</p>
                    </div>
                    <div class="cart-item-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                        <span>${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                        <button onclick="removeFromCart(${item.id})" style="margin-left: 1rem; color: #ff6b6b;">Remover</button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });

            cartTotal.textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;
        }

        // Favorites
        function toggleFavorite(productId) {
            if (favorites.includes(productId)) {
                favorites = favorites.filter(id => id !== productId);
                showNotification('Removido dos favoritos');
            } else {
                favorites.push(productId);
                showNotification('Adicionado aos favoritos!');
            }
            displayProducts(filteredProducts);
        }

        // Product Details Functions
        function showProductDetails(productId) {
            const product = window.produtosDB.find(p => p.id === productId);
            const modal = document.getElementById('productModal');
            const content = document.getElementById('productDetailsContent');
            
            // Sample reviews for demonstration
            const sampleReviews = [
                { name: "Maria Silva", rating: 5, comment: "Perfume incrível! Duração excelente e fragrância marcante." },
                { name: "João Santos", rating: 4, comment: "Muito bom, recomendo. Chegou rápido e bem embalado." },
                { name: "Ana Costa", rating: 5, comment: "Superou minhas expectativas. Vou comprar novamente!" }
            ];
            
            content.innerHTML = `
                <div class="product-details">
                    <div class="product-details-image">
                        ${product.image.endsWith('.png') ? `<img src="${product.image}" alt="${product.name}" style="max-width:100%;max-height:100%;">` : product.image}
                    </div>
                    <div class="product-details-info">
                        <h2>${product.name}</h2>
                        <div class="rating">
                            <span class="stars">${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5-Math.floor(product.rating))}</span>
                            <span>${product.rating} (${product.reviews} avaliações)</span>
                        </div>
                        <div class="product-details-price">R$ ${product.price.toFixed(2).replace('.', ',')}</div>
                        <div class="product-details-description">
                            ${product.fullDescription}
                        </div>
                        
                            
                        <button class="submit-btn" onclick="addToCart(${product.id}); closeProductDetails();">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
                
                <div class="reviews-section">
                    <h3>Avaliações dos Clientes</h3>
                    ${sampleReviews.map(review => `
                        <div class="review-item">
                            <div class="review-header">
                                <span class="reviewer-name">${review.name}</span>
                                <span class="review-stars">${'★'.repeat(review.rating)}${'☆'.repeat(5-review.rating)}</span>
                            </div>
                            <p>${review.comment}</p>
                        </div>
                    `).join('')}
                </div>
            `;
            
            modal.style.display = 'block';
        }

        function closeProductDetails() {
            document.getElementById('productModal').style.display = 'none';
        }

        // Modal Functions
        function openLogin() {
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeLogin() {
            document.getElementById('loginModal').style.display = 'none';
        }

        function openCart() {
            document.getElementById('cartModal').style.display = 'block';
        }

        function closeCart() {
            document.getElementById('cartModal').style.display = 'none';
        }

        function openCheckout() {
            if (cart.length === 0) {
                showNotification('Seu carrinho está vazio!');
                return;
            }
            closeCart();
            document.getElementById('checkoutModal').style.display = 'block';
        }

        function closeCheckout() {
            document.getElementById('checkoutModal').style.display = 'none';
        }

        // Form Setup
        function setupForms() {
            // Login Form
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('userName').value;
                const email = document.getElementById('userEmail').value;
                
                currentUser = { name, email };
                showNotification(`Bem-vindo(a), ${name}!`);
                closeLogin();
            });

            // Checkout Form
            document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Pedido confirmado! (DEMO - Nenhum pagamento foi processado)');
                cart = [];
                updateCartCount();
                closeCheckout();
            });
        }

        // Utility Functions
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Carrossel de imagens para cada produto
let currentImages = {};
function prevImage(id) {
    const imgs = document.querySelectorAll('.product-card[data-id="'+id+'"] .product-images img');
    if (!currentImages[id]) currentImages[id] = 0;
    currentImages[id] = (currentImages[id] - 1 + imgs.length) % imgs.length;
    imgs.forEach((img, i) => img.style.display = (i === currentImages[id]) ? 'block' : 'none');
}
function nextImage(id) {
    const imgs = document.querySelectorAll('.product-card[data-id="'+id+'"] .product-images img');
    if (!currentImages[id]) currentImages[id] = 0;
    currentImages[id] = (currentImages[id] + 1) % imgs.length;
    imgs.forEach((img, i) => img.style.display = (i === currentImages[id]) ? 'block' : 'none');
}
// Modal de detalhes
function showProductDetails(id) {
    // Busca os dados do produto via PHP embutido
    const modal = document.getElementById('productModal');
    const details = document.getElementById('productDetailsContent');
    <?php
    $result = $mysqli->query("SELECT * FROM produtos ORDER BY id DESC");
    $produtos = [];
    while($p = $result->fetch_assoc()) {
        $p['imagens'] = array_map('trim', explode(',', $p['imagem']));
        $produtos[] = $p;
    }
    ?>
    const produtos = <?= json_encode($produtos) ?>;
    const prod = produtos.find(p => p.id == id);
    if (!prod) return;
    let imgsHtml = '';
    prod.imagens.forEach((img, i) => {
        imgsHtml += `<img src="${img}" style="width:100%;max-width:300px;border-radius:12px;display:${i===0?'block':'none'};margin-bottom:8px;">`;
    });
    details.innerHTML = `
        <div style='text-align:center;'>${imgsHtml}</div>
        <h2>${prod.nome}</h2>
        <p>${prod.descricao}</p>
        <div class='product-price'>R$ ${parseFloat(prod.preco).toFixed(2).replace('.', ',')}</div>
        <button class='add-to-cart' onclick='addToCart({id:${prod.id}, nome:"${prod.nome}", preco:${prod.preco}})'>Adicionar ao Carrinho</button>
    `;
    modal.style.display = 'block';
}
function closeProductDetails() {
    document.getElementById('productModal').style.display = 'none';
}
</script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97119f93976addeb',t:'MTc1NTUyMjMzMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>

    </footer>
</html>
