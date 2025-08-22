<Sect></Sect><!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavelle - Sobre Nós</title>
    <style>
        .cart-icon {
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

        .cart-icon:hover {
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
            padding: 4rem 0;
            text-align: center;
        }

        .page-header h1 {
            font-size: 3.5rem;
            color: #8b4b8c;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .page-header p {
            font-size: 1.3rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease 0.2s both;
        }

        /* Story Section */
        .story-section {
            padding: 5rem 0;
            background: white;
        }

        .story-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 4rem;
        }

        .story-text h2 {
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 2rem;
        }

        .story-text p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .story-image {
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            height: 400px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #8b4b8c;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Timeline Section */
        .timeline-section {
            padding: 5rem 0;
            background: #fafafa;
        }

        .timeline-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background: #8b4b8c;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            animation: fadeInUp 1s ease;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background: #8b4b8c;
            border: 4px solid #fff;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
        }

        .timeline-item:nth-child(even)::after {
            left: -10px;
        }

        .timeline-content {
            padding: 2rem;
            background: white;
            position: relative;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .timeline-content h3 {
            color: #8b4b8c;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .timeline-year {
            color: #999;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* Values Section */
        .values-section {
            padding: 5rem 0;
            background: white;
        }

        .values-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .value-card {
            background: #f8f4f0;
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .value-card:hover {
            transform: translateY(-10px);
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .value-card h3 {
            color: #8b4b8c;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .value-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Team Section */
        .team-section {
            padding: 5rem 0;
            background: #fafafa;
        }

        .team-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .team-member {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .member-photo {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #8b4b8c;
        }

        .team-member h3 {
            color: #8b4b8c;
            margin-bottom: 0.5rem;
        }

        .team-member .role {
            color: #999;
            font-style: italic;
            margin-bottom: 1rem;
        }

        .team-member p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Process Section */
        .process-section {
            padding: 5rem 0;
            background: white;
        }

        .process-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .process-step {
            text-align: center;
            padding: 2rem;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: #8b4b8c;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 1.5rem;
        }

        .process-step h3 {
            color: #8b4b8c;
            margin-bottom: 1rem;
        }

        .process-step p {
            color: #666;
            line-height: 1.6;
        }

        /* Certifications Section */
        .certifications-section {
            padding: 5rem 0;
            background: #fafafa;
        }

        .certifications-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .certifications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .certification-item {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .cert-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #8b4b8c;
        }

        .certification-item h3 {
            color: #8b4b8c;
            margin-bottom: 0.5rem;
        }

        .certification-item p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 5rem 0;
            background: white;
        }

        .testimonials-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #8b4b8c;
            margin-bottom: 3rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial {
            background: #f8f4f0;
            padding: 2rem;
            border-radius: 15px;
            position: relative;
        }

        .testimonial::before {
            content: '"';
            font-size: 4rem;
            color: #8b4b8c;
            position: absolute;
            top: -10px;
            left: 20px;
        }

        .testimonial-text {
            color: #666;
            font-style: italic;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
        }

        .testimonial-author {
            color: #8b4b8c;
            font-weight: bold;
        }

        .testimonial-rating {
            color: #ffd700;
            margin-top: 0.5rem;
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
            
            .page-header h1 {
                font-size: 2.5rem;
            }
            
            .search-box input {
                width: 150px;
            }
            
            .story-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item::after {
                left: 21px;
            }
            
            .timeline-item:nth-child(even) {
                left: 0%;
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
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="container">
            <a href="index.php" class="logo">Lavelle</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="paginaprodutos.php">Nossos Produtos</a></li>
                <li><a href="#" style="color: #8b4b8c;">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
            <div class="search-cart">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Buscar perfumes...">
                </div>
              
                 
                 
                </button>
                <?php if(isset($_SESSION['id'])): ?>
                <?php else: ?>
                    <a class="cart-icon" href="../login com database/index.php">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Nossa História</h1>
            <p>Conheça a jornada da Lavelle Perfumaria e nossa paixão por criar experiências olfativas únicas e memoráveis</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="story-content">
                <div class="story-text">
                    <h2>Uma Paixão que Começou </h2>
                    <p>A Lavelle Perfumaria nasceu do sonho de criar fragrâncias que contassem histórias. Fundada por especialistas em perfumaria com  experiência, nossa marca representa a união perfeita entre tradição e inovação.</p>
                    <p>Desde o início, nossa missão tem sido democratizar o acesso a perfumes de alta qualidade, oferecendo fragrâncias premium com preços justos e atendimento personalizado.</p>
                    <p>Hoje, somos reconhecidos como uma das principais perfumarias do país, com milhares de clientes satisfeitos e uma reputação construída sobre confiança, qualidade e excelência.</p>
                </div>
                <div class="story-image">
                    <img src="./logo.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <h2>Nossa Jornada</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year"></div>
                        <h3>Fundação</h3>
                        <p>Abertura da primeiro site, com foco em perfumes importados de alta qualidade.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year"></div>
                        <h3>Expansão Digital</h3>
                        <p>Lançamento da loja online, permitindo atender clientes em todo o Brasil com entrega rápida e segura.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year"></div>
                        <h3>Linha Própria</h3>
                        <p>Desenvolvimento da primeira linha de perfumes exclusivos Lavelle, criada por perfumistas renomados.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year"></div>
                        <h3>Certificação Premium</h3>
                        <p>Conquista das principais certificações de qualidade e sustentabilidade do mercado de cosméticos.</p>
                    </div>
                </div>
                
              
                    
                        
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2>Nossos Valores</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Missão</h3>
                    <p>Proporcionar experiências olfativas únicas e memoráveis, oferecendo perfumes de alta qualidade que expressem a personalidade e estilo de cada cliente.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Visão</h3>
                    <p>Ser reconhecida como a principal referência em perfumaria no Brasil, inovando constantemente e mantendo a excelência em produtos e atendimento.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Qualidade</h3>
                    <p>Compromisso inabalável com a qualidade em todos os aspectos: desde a seleção de fornecedores até o atendimento ao cliente final.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Sustentabilidade</h3>
                    <p>Responsabilidade ambiental em todos os processos, priorizando fornecedores sustentáveis e embalagens eco-friendly.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Confiança</h3>
                    <p>Relacionamentos duradouros baseados em transparência, honestidade e compromisso com a satisfação do cliente.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon"></div>
                    <h3>Inovação</h3>
                    <p>Busca constante por novidades e tendências, sempre oferecendo as mais recentes fragrâncias e tecnologias do mercado.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2>Nossa Equipe</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo"><img src="./caii.png" alt="Carlos Mendes" style="width:100%;height:100%;object-fit:cover;border-radius:50%;"></div>
                    <h3>Caio Machado</h3>
                    <div class="role">DEV TEAM</div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo"><img src="./lucas (1).png" alt="Ana Rodrigues" style="width:100%;height:100%;object-fit:cover;border-radius:50%;"></div>
                    <h3>Lucas Henrique</h3>
                    <div class="role">DEV TEAM</div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo"><img src="./sophia.png" alt="Roberto Silva" style="width:100%;height:100%;object-fit:cover;border-radius:50%;"></div>
                    <h3>Sophia Ruiz</h3>
                    <div class="role">SCRUM MASTER</div>
                    <p></p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo"><img src="./ana.png" alt="Mariana Costa" style="width:100%;height:100%;object-fit:cover;border-radius:50%;"></div>
                    <h3>Ana Victoria
                    </h3>
                    <div class="role">Designer de Produtos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <h2>Nosso Processo de Criação</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Pesquisa & Inspiração</h3>
                    <p>Estudamos tendências globais, comportamento do consumidor e buscamos inspiração em arte, natureza e cultura para criar conceitos únicos.</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Desenvolvimento</h3>
                    <p>Nossa equipe de perfumistas trabalha na criação das fórmulas, testando diferentes combinações de notas até encontrar a harmonia perfeita.</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Testes de Qualidade</h3>
                    <p>Realizamos rigorosos testes de qualidade, durabilidade e segurança, garantindo que cada fragrância atenda aos mais altos padrões.</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Produção</h3>
                    <p>Produção em pequenos lotes para garantir frescor e qualidade, utilizando apenas ingredientes premium selecionados.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
   

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2>O Que Nossos Clientes Dizem</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-text">
                        A Lavelle mudou completamente minha relação com perfumes. A qualidade é excepcional e o atendimento é sempre impecável. Recomendo de olhos fechados!
                    </div>
                    <div class="testimonial-author">Maria Santos</div>
                    <div class="testimonial-rating">★★★★★</div>
                </div>
                
                <div class="testimonial">
                    <div class="testimonial-text">
                        Compro na Lavelle há mais de 5 anos. A variedade de produtos é incrível e sempre encontro fragrâncias exclusivas que não acho em outros lugares.
                    </div>
                    <div class="testimonial-author">João Oliveira</div>
                    <div class="testimonial-rating">★★★★★</div>
                </div>
                
                <div class="testimonial">
                    <div class="testimonial-text">
                        O que mais me impressiona é a consultoria personalizada. Eles realmente entendem do assunto e sempre me ajudam a escolher o perfume perfeito.
                    </div>
                    <div class="testimonial-author">Ana Paula</div>
                    <div class="testimonial-rating">★★★★★</div>
                </div>
            </div>
        </div>
    </section>

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

    <script>
function openCart() {
    showNotification('Carrinho disponível na página de produtos!');
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}
        function openCart() {
            showNotification('Carrinho disponível na página de produtos!');
        }
        let currentUser = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupForms();
            animateOnScroll();
        });

        // Navigation Functions
        function goToProducts() {   
            window.location.href = 'paginaprodutos.php';
        }

        // Setup Forms
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

        // Modal Functions
        function openLogin() {
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeLogin() {
            document.getElementById('loginModal').style.display = 'none';
        }

        // Animate on Scroll
        function animateOnScroll() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 1s ease forwards';
                    }
                });
            });

            document.querySelectorAll('.value-card, .team-member, .process-step, .certification-item, .testimonial').forEach(el => {
                observer.observe(el);
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

        // Search redirect
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                window.location.href = 'paginaprodutos.php';
            }
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9711b705400f6ea6',t:'MTc1NTUyMzI5My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
