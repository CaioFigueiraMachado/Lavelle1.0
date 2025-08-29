<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if(isset($_SESSION['id'])) {
    // Buscar dados do usuário do banco
    include('../login com database/conexao.php');
    $id = $_SESSION['id'];
    // Upload de foto (deve ser antes de qualquer saída HTML)
    if(isset($_POST['alterar_foto']) && isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotos_dir = '../login com database/fotos';
        if (!is_dir($fotos_dir)) {
            mkdir($fotos_dir, 0777, true);
        }
        // Apagar foto anterior se existir
        $sql_old = "SELECT foto FROM usuarios WHERE id = '$id'";
        $result_old = $mysqli->query($sql_old);
        if($result_old && $result_old->num_rows > 0) {
            $old = $result_old->fetch_assoc();
            if(isset($old['foto']) && $old['foto'] && file_exists($fotos_dir . '/' . basename($old['foto']))) {
                unlink($fotos_dir . '/' . basename($old['foto']));
            }
        }
        // Salvar nova foto com nome único por usuário
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_nome = 'foto_' . $id . '.' . $ext;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $fotos_dir . '/' . $foto_nome)) {
            $sql = "UPDATE usuarios SET foto = 'fotos/$foto_nome' WHERE id = '$id'";
            $mysqli->query($sql);
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Erro ao salvar foto.");</script>';
        }
    }
    $sql = "SELECT nome, email, foto FROM usuarios WHERE id = '$id'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavelle - Perfumaria Premium - Home</title>
    <style>
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

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            padding: 4rem 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            color: #8b4b8c;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease 0.2s both;
        }

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

        /* Categories */
        .categories {
            padding: 4rem 0;
            background: white;
        }

        .categories h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card h3 {
            font-size: 1.5rem;
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        /* Products CTA Section */
        .products-cta {
            padding: 4rem 0;
            background: #fafafa;
            text-align: center;
        }

        .products-cta h2 {
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        .products-cta p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
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
            height: 200px;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin-bottom: 1rem;
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
        }

        .add-to-cart:hover {
            background: #6d3a6e;
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
            margin: 5% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }
            /* Perfil Modal Custom */
            #profileModal .container {
                background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
                box-shadow: 0 8px 32px rgba(139,75,140,0.12);
                border-radius: 25px;
                padding: 2.5rem 2rem 2rem 2rem;
                position: relative;
            }
            #profileModal h2 {
                font-size: 2rem;
                color: #8b4b8c;
                margin-bottom: 1.5rem;
                font-family: 'Georgia', serif;
                letter-spacing: 1px;
            }
            #profileModal img {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0 2px 12px rgba(139,75,140,0.15);
                border: 4px solid #e8ddd4;
                margin-bottom: 1rem;
                background: #fff;
            }
            #profileModal label {
                display: block;
                margin-bottom: 0.5rem;
                color: #8b4b8c;
                font-weight: 500;
            }
            #profileModal input[type="file"] {
                display: block;
                margin: 0 auto 1rem auto;
                padding: 0.3rem;
                border-radius: 10px;
                border: 1px solid #e8ddd4;
                background: #fafafa;
            }
            #profileModal p {
                font-size: 1.1rem;
                color: #333;
                margin-bottom: 0.7rem;
                background: #f8f4f0;
                padding: 0.5rem 1rem;
                border-radius: 12px;
                box-shadow: 0 1px 4px rgba(139,75,140,0.05);
            }
            #profileModal .cta-button {
                width: 100%;
                margin-top: 1rem;
                font-size: 1.1rem;
            }
            #profileModal .back-button {
                width: 100%;
                background: #e8ddd4;
                color: #8b4b8c;
                border: none;
                border-radius: 25px;
                padding: 0.7rem 0;
                font-size: 1rem;
                cursor: pointer;
                margin-top: 1rem;
                transition: background 0.3s;
            }
            #profileModal .back-button:hover {
                background: #d1bfcf;
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

        /* Animations */
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

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .search-box input {
                width: 150px;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        .hidden {
            display: none;
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

        @media (max-width: 768px) {
            .product-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="container">
    <?php if(isset($_SESSION['id'])): ?>
       
    <?php endif; ?>
    <!-- Modal de Perfil -->
    <?php if(isset($_SESSION['id'])): ?>
    <div id="profileModal" class="modal" style="display:none;">
        <div class="container" style="max-width:400px; margin:5rem auto; background:#fff; padding:2rem; border-radius:15px; box-shadow:0 2px 10px rgba(0,0,0,0.08);">
            <h2 style="color:#8b4b8c; text-align:center;">Meu Perfil</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div style="text-align:center; margin-bottom:1rem;">
                    <img src="<?php echo isset($user['foto']) && $user['foto'] ? '../login com database/' . $user['foto'] : 'https://via.placeholder.com/100x100?text=Foto'; ?>" alt="Foto de perfil" style="width:100px; height:100px; border-radius:50%; object-fit:cover;">
                </div>
                <label for="foto">Alterar foto:</label>
                <input type="file" name="foto" id="foto" accept="image/*" style="margin-bottom:1rem;">
                <button type="submit" name="alterar_foto" class="cta-button">Salvar Foto</button>
            </form>
            <p><strong>Nome:</strong> <?php echo isset($user['nome']) ? htmlspecialchars($user['nome']) : 'Não disponível'; ?></p>
            <p><strong>Email:</strong> <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'Não disponível'; ?></p>
            <form action="../login com database/logout.php" method="POST">
                <button type="submit" class="cta-button" style="background:#ff6b6b;">Deslogar</button>
            </form>
            <button onclick="closeProfile()" class="back-button" style="margin-top:1rem;">Fechar</button>
        </div>
    </div>
    <?php endif; ?>
    <script>
        function openProfile() {
            document.getElementById('profileModal').style.display = 'block';
        }
        function closeProfile() {
            document.getElementById('profileModal').style.display = 'none';
        }
    </script>
            <a href="#" class="logo">Lavelle</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="paginaprodutos.php">Nossos Produtos</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
                <?php if(isset($_SESSION['email']) && $_SESSION['email'] === 'adm@gmail.com'): ?>
                    <li class="nav-admin">
                        <a href="admin.php" style="color:#50382b; font-weight:500;">Admin</a>
                        <ul style="list-style:none; margin:0; padding:0; position:absolute; background:#efdacb; border-radius:8px; box-shadow:0 2px 8px #e2acac; min-width:140px; display:none; z-index:999;">
                            <li><a href="produtos_admin.php" style="color:#50382b; font-weight:500; display:block; padding:8px 16px;">GEN PRODUTOS</a></li>
                        </ul>
                    </li>
                    <script>
                    // Dropdown simples para Admin
                    document.addEventListener('DOMContentLoaded', function() {
                        var navAdmin = document.querySelector('.nav-admin');
                        var submenu = navAdmin.querySelector('ul');
                        navAdmin.addEventListener('mouseenter', function() {
                            submenu.style.display = 'block';
                        });
                        navAdmin.addEventListener('mouseleave', function() {
                            submenu.style.display = 'none';
                        });
                    });
                    </script>
                <?php endif; ?>
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
                    <button class="cart-icon" onclick="openProfile()" style="margin-right:0.5rem;">Perfil</button>
                <?php else: ?>
                    <a class="cta-button" href="../login com database/login.php">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <h1>Desperte Seus Sentidos</h1>
            <p>Descubra fragrâncias únicas que contam sua história</p>
            <button class="cta-button" onclick="goToProducts()">Explorar Coleção</button>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories">
        <div class="container">
            <h2>Nossas Categorias</h2>
            <div class="category-grid">
                <div class="category-card" onclick="goToProducts('masculino')">
                    <h3>Masculino</h3>
                    <p>Fragrâncias marcantes e sofisticadas</p>
                </div>
                <div class="category-card" onclick="goToProducts('feminino')">
                    <h3>Feminino</h3>
                    <p>Elegância e delicadeza em cada borrifo</p>
                </div>
                <div class="category-card" onclick="goToProducts('todos')">
                    <h3>Elegancia</h3>
                    <p>Perfumes para todos os momentos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action for Products -->
    <section class="products-cta">
        <div class="container">
            <h2>Descubra Nossa Coleção Exclusiva</h2>
            <p>Mais de 50 fragrâncias cuidadosamente selecionadas para você</p>
            <button class="cta-button" onclick="goToProducts()">Ver Todos os Produtos</button>
        </div>
    </section>

    <!-- About Section -->
    

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Contato</h3>
                    <a href="#">Telefone: (12) 9953-2672</a>
                    <a href="#">E-mail: lavelle@gmail.com</a>
                    <a href="#">Endereço Av. Monsenhor Theodomiro Lobo, 100 - Parque Res. Maria Elmira, Caçapava - SP,</a>
                </div>
                <div class="footer-section">
                    <h3>Redes Sociais</h3>
                    <a href="https://www.facebook.com/?locale=pt_BR">Facebook</a>
                    <a href="https://www.instagram.com/?next=%2F">Instagram</a>
                    <a href="https://x.com/">Twitter</a>
                </div>
                <div class="footer-section">
                    <h3>Políticas</h3>
                    <a href="#">Política de Privacidade</a>
                    <a href="#">Termos de Uso</a>
                    <a href="#">Trocas e Devoluções</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Lavelle Perfumaria. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

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
            <h2>Carrinho</h2>
            <p style="text-align: center; padding: 2rem;">
                O carrinho completo está disponível na página de produtos!<br>
                <button class="cta-button" onclick="goToProducts(); closeCart();" style="margin-top: 1rem;">
                    Ir para Produtos
                </button>
            </p>
        </div>
    </div>





    <script>
        // Carrinho persistente via localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentUser = null;

        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        function addToCart(product) {
            // product: {id, nome, preco, quantidade, ...}
            const idx = cart.findIndex(item => item.id === product.id);
            if (idx > -1) {
                cart[idx].quantidade += product.quantidade || 1;
            } else {
                cart.push({...product, quantidade: product.quantidade || 1});
            }
            saveCart();
            showNotification('Produto adicionado ao carrinho!');
        }

        function updateCartCount() {
            const count = cart.reduce((acc, item) => acc + item.quantidade, 0);
            const el = document.getElementById('cartCount');
            if (el) el.textContent = count;
        }

        // Inicializa contador ao carregar
        document.addEventListener('DOMContentLoaded', function() {
            setupForms();
            updateCartCount();
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupForms();
        });

        // Navigation Functions
        function goToProducts(category = '') {
            // Redireciona para paginaprodutos.html
            window.location.href = 'paginaprodutos.php';
        }

        // Modal Functions
        function openLogin() {
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeLogin() {
            document.getElementById('loginModal').style.display = 'none';
        }

        function openCart() {
            showNotification('Carrinho disponível na página de produtos!');
        }

        function closeCart() {
            // Not needed on homepage
        }

        function openCheckout() {
            showNotification('Checkout disponível na página de produtos!');
        }

        function closeCheckout() {
            // Not needed on homepage
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
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97119c755341ddeb',t:'MTc1NTUyMjIwNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
