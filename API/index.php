<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquivo de Moda & Desfiles de Luxo (API em Tempo Real)</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* RESET & VARIÁVEIS BASE */
        :root {
            --bg-main: #0c0d0e;
            --bg-card: #151719;
            --bg-card-hover: #1e2125;
            --gold: #dfb259;
            --gold-hover: #f3c653;
            --gold-glow: rgba(223, 178, 89, 0.25);
            --text-primary: #f0f0f0;
            --text-muted: #a0a5ad;
            --border-color: rgba(223, 178, 89, 0.2);
            --font-heading: 'Cinzel', serif;
            --font-body: 'Montserrat', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--bg-main); color: var(--text-primary); font-family: var(--font-body); line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* NAVEGAÇÃO */
        .navbar { background-color: rgba(12, 13, 14, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-color); position: fixed; top: 0; width: 100%; z-index: 1000; padding: 18px 0; }
        .nav-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }
        .brand-logo { font-family: var(--font-heading); font-size: 1.4rem; font-weight: 700; color: var(--gold); text-decoration: none; letter-spacing: 2px; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; list-style: none; gap: 25px; }
        .nav-links a { color: var(--text-primary); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.3s; display: flex; align-items: center; gap: 8px; }
        .nav-links a:hover { color: var(--gold); }

        /* HERO SECTION */
        .hero { height: 85vh; display: flex; align-items: center; justify-content: center; text-align: center; background: linear-gradient(180deg, rgba(12,13,14,0.6) 0%, rgba(12,13,14,1) 100%), url('https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1920&q=80') center/cover; padding: 0 20px; margin-top: 60px; }
        .hero-content { max-width: 800px; }
        .hero-subtitle { color: var(--gold); font-size: 0.85rem; letter-spacing: 4px; text-transform: uppercase; font-weight: 600; }
        .hero-title { font-family: var(--font-heading); font-size: 3.5rem; margin: 15px 0; letter-spacing: 2px; color: #ffffff; }
        .hero-desc { color: var(--text-muted); font-size: 1.1rem; margin-bottom: 30px; font-weight: 300; }
        .hero-actions { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }

        /* BOTÕES */
        .btn { padding: 12px 28px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px; border: none; }
        .btn-gold { background-color: var(--gold); color: #000; }
        .btn-gold:hover { background-color: var(--gold-hover); box-shadow: 0 0 15px var(--gold-glow); }
        .btn-outline { background: transparent; color: var(--gold); border: 1px solid var(--gold); }
        .btn-outline:hover { background-color: var(--gold); color: #000; }

        /* SECÇÕES */
        .section { padding: 80px 0; }
        .bg-darker { background-color: #080809; }
        .section-header { text-align: center; margin-bottom: 40px; }
        .section-tag { color: var(--gold); font-size: 0.8rem; letter-spacing: 3px; font-weight: 600; }
        .section-title { font-family: var(--font-heading); font-size: 2.2rem; margin-top: 5px; }
        .gold-line { width: 60px; height: 2px; background-color: var(--gold); margin: 15px auto 0; }

        /* FILTROS & BUSCA */
        .filter-wrapper { display: flex; flex-direction: column; gap: 20px; margin-bottom: 40px; align-items: center; }
        .search-box { position: relative; width: 100%; max-width: 500px; }
        .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--gold); }
        .search-box input { width: 100%; padding: 12px 15px 12px 45px; background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: #fff; font-size: 0.95rem; outline: none; }
        .search-box input:focus { border-color: var(--gold); }
        .filter-buttons { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .filter-btn { background-color: var(--bg-card); color: var(--text-muted); border: 1px solid var(--border-color); padding: 8px 18px; border-radius: 20px; cursor: pointer; font-size: 0.85rem; transition: all 0.3s; }
        .filter-btn.active, .filter-btn:hover { background-color: var(--gold); color: #000; font-weight: 600; }

        /* CARTÕES */
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .card { background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 8px; padding: 25px; transition: transform 0.3s, box-shadow 0.3s; display: flex; flex-direction: column; justify-content: space-between; }
        .card:hover { transform: translateY(-5px); border-color: var(--gold); box-shadow: 0 8px 25px rgba(0,0,0,0.5); }
        .card-img { width: 100%; height: 320px; object-fit: cover; border-radius: 6px; margin-bottom: 15px; border: 1px solid var(--border-color); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .card-year { font-family: var(--font-heading); font-size: 1.6rem; color: var(--gold); font-weight: 700; }
        .card-location { font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 5px; }
        .card-theme { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; color: #fff; }
        .card-desc { font-size: 0.88rem; color: var(--text-muted); margin-bottom: 20px; flex-grow: 1; }
        .card-footer { border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px; display: flex; justify-content: space-between; align-items: center; }
        .card-models { font-size: 0.8rem; color: var(--gold); }

        /* TENDÊNCIAS */
        .trends-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .trend-card { background-color: var(--bg-card); border: 1px solid var(--border-color); padding: 30px; border-radius: 8px; text-align: center; }
        .trend-icon { font-size: 2.2rem; color: var(--gold); margin-bottom: 15px; }
        .trend-card h3 { font-family: var(--font-heading); font-size: 1.3rem; margin-bottom: 5px; }
        .trend-subtitle { font-size: 0.8rem; color: var(--gold); margin-bottom: 15px; text-transform: uppercase; }
        .trend-card p { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px; }
        .trend-tags { display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; }
        .trend-tags span { background-color: rgba(223, 178, 89, 0.1); color: var(--gold); padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; }

        /* QUIZ */
        .quiz-box { background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 40px; max-width: 700px; margin: 0 auto; }
        .quiz-header { text-align: center; margin-bottom: 30px; }
        .quiz-step h4 { font-size: 1.1rem; margin-bottom: 20px; text-align: center; }
        .quiz-options { display: flex; flex-direction: column; gap: 12px; }
        .quiz-opt-btn { background-color: var(--bg-main); color: var(--text-primary); border: 1px solid var(--border-color); padding: 15px 20px; border-radius: 6px; cursor: pointer; font-size: 0.95rem; text-align: left; transition: all 0.3s; display: flex; align-items: center; gap: 12px; }
        .quiz-opt-btn:hover { border-color: var(--gold); background-color: var(--bg-card-hover); color: var(--gold); }
        .quiz-result { text-align: center; padding: 20px 0; display: none; }
        .result-icon { font-size: 3rem; color: var(--gold); margin-bottom: 15px; }
        .quiz-result h3 { font-family: var(--font-heading); font-size: 1.8rem; color: var(--gold); margin-bottom: 10px; }
        .quiz-result p { color: var(--text-muted); margin-bottom: 25px; }

        /* MODAL */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.85); backdrop-filter: blur(5px); z-index: 2000; justify-content: center; align-items: center; padding: 20px; }
        .modal-content { background-color: var(--bg-card); border: 1px solid var(--gold); border-radius: 10px; max-width: 600px; width: 100%; padding: 30px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.8); }
        .modal-close { position: absolute; top: 15px; right: 20px; font-size: 1.8rem; color: var(--text-muted); cursor: pointer; transition: color 0.3s; }
        .modal-close:hover { color: var(--gold); }

        /* RODAPÉ */
        .footer { border-top: 1px solid var(--border-color); padding: 30px 0; text-align: center; background-color: #080809; }
        .footer-content p { font-size: 0.85rem; color: var(--text-muted); }
        .footer-sub { font-size: 0.75rem; margin-top: 5px; opacity: 0.6; }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.2rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <!-- Navegação -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="brand-logo"><i class="fa-solid fa-gem"></i> HAUTE MODA API</a>
            <ul class="nav-links">
                <li><a href="#catalogo"><i class="fa-solid fa-person-dress"></i> Coleções</a></li>
                <li><a href="#tendencias"><i class="fa-solid fa-wand-magic-sparkles"></i> Tendências</a></li>
                <li><a href="#quiz"><i class="fa-solid fa-compass"></i> Guia de Estilo</a></li>
            </ul>
        </div>
    </nav>

    <!-- Cabeçalho -->
    <header class="hero">
        <div class="hero-content">
            <span class="hero-subtitle">INTEGRAÇÃO DE DADOS VIA API EXTERNA</span>
            <h1 class="hero-title">Coleções de Moda em Tempo Real</h1>
            <p class="hero-desc">Consulte as últimas coleções e vestuário diretamente de uma API REST externa em tempo real.</p>
            <div class="hero-actions">
                <a href="#catalogo" class="btn btn-gold"><i class="fa-solid fa-compass"></i> Explorar Coleções</a>
                <a href="#quiz" class="btn btn-outline"><i class="fa-solid fa-sparkles"></i> Descubra o Seu Estilo</a>
            </div>
        </div>
    </header>

    <!-- Catálogo -->
    <section id="catalogo" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">CATÁLOGO EM TEMPO REAL</span>
                <h2 class="section-title">Resultados da API Externa</h2>
                <div class="gold-line"></div>
            </div>

            <div class="filter-wrapper">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Digite para pesquisar qualquer item ou ano na API...">
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Todos os Anos</button>
                    <button class="filter-btn" data-filter="2024">2024</button>
                    <button class="filter-btn" data-filter="2021">2021</button>
                    <button class="filter-btn" data-filter="2018">2018</button>
                    <button class="filter-btn" data-filter="2016">2016</button>
                    <button class="filter-btn" data-filter="2014">2014</button>
                </div>
            </div>

            <div id="showsGrid" class="cards-grid">
                <p style="grid-column: 1/-1; text-align: center; color: var(--gold); padding: 40px;">
                    <i class="fa-solid fa-spinner fa-spin"></i> A carregar dados da API em tempo real...
                </p>
            </div>
        </div>
    </section>

    <!-- Tendências -->
    <section id="tendencias" class="section bg-darker">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">ESTÉTICAS EM ALTA</span>
                <h2 class="section-title">Guia de Tendências & Estilos</h2>
                <div class="gold-line"></div>
            </div>

            <div class="trends-grid">
                <div class="trend-card">
                    <div class="trend-icon"><i class="fa-solid fa-crown"></i></div>
                    <h3>Quiet Luxury</h3>
                    <p class="trend-subtitle">Elegância Minimalista</p>
                    <p>Cortes impecáveis, tons neutros e materiais nobres sem logótipos ostensivos. O verdadeiro luxo que não precisa gritar.</p>
                    <div class="trend-tags"><span>Alfaiataria</span><span>Seda</span><span>Tons Neutros</span></div>
                </div>

                <div class="trend-card">
                    <div class="trend-icon"><i class="fa-solid fa-shirt"></i></div>
                    <h3>Streetwear Chic</h3>
                    <p class="trend-subtitle">Urbano & Alta-Costura</p>
                    <p>A fusão entre o conforto das ruas e o corte refinado das casas de luxo, destacando jaquetas oversized e tênis exclusivos.</p>
                    <div class="trend-tags"><span>Oversized</span><span>Couro</span><span>Sneakers</span></div>
                </div>

                <div class="trend-card">
                    <div class="trend-icon"><i class="fa-solid fa-feather"></i></div>
                    <h3>Y2K Nostalgia</h3>
                    <p class="trend-subtitle">Anos 2000 Redefinidos</p>
                    <p>Brilho metálico, silhuetas futuristas e elementos arrojados trazidos diretamente das passarelas do início do milénio.</p>
                    <div class="trend-tags"><span>Metalizados</span><span>Cintura Baixa</span><span>Óculos Retrô</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quiz -->
    <section id="quiz" class="section">
        <div class="container">
            <div class="quiz-box">
                <div class="quiz-header">
                    <span class="section-tag">DESCOBERTA GUIADA</span>
                    <h2 class="section-title">Qual é a sua Combinação Perfeita?</h2>
                    <p>Responda a 2 perguntas simples para encontrar o estilo ideal.</p>
                </div>

                <div class="quiz-content" id="quizContainer">
                    <div class="quiz-step active" id="step1">
                        <h4>1. Qual é a sua ocasião ideal para vestir algo marcante?</h4>
                        <div class="quiz-options">
                            <button class="quiz-opt-btn" onclick="selectQuizOption(1, 'formal')"><i class="fa-solid fa-champagne-glasses"></i> Evento de Gala ou Tapete Vermelho</button>
                            <button class="quiz-opt-btn" onclick="selectQuizOption(1, 'casual')"><i class="fa-solid fa-city"></i> Passeio Casual & Urbano na Cidade</button>
                            <button class="quiz-opt-btn" onclick="selectQuizOption(1, 'festa')"><i class="fa-solid fa-music"></i> Festival de Música ou Noite Vibrante</button>
                        </div>
                    </div>

                    <div class="quiz-step" id="step2" style="display: none;">
                        <h4>2. Que tipo de paleta de cores prefere nas suas roupas?</h4>
                        <div class="quiz-options">
                            <button class="quiz-opt-btn" onclick="showQuizResult('neutra')"><i class="fa-solid fa-palette"></i> Tons Neutros (Preto, Nude, Branco)</button>
                            <button class="quiz-opt-btn" onclick="showQuizResult('vibrante')"><i class="fa-solid fa-bolt"></i> Cores Vibrantes e Estampados Arrojados</button>
                            <button class="quiz-opt-btn" onclick="showQuizResult('dourada')"><i class="fa-solid fa-sun"></i> Tons Dourados e Metalizados</button>
                        </div>
                    </div>

                    <div class="quiz-result" id="quizResult">
                        <div class="result-icon"><i class="fa-solid fa-star"></i></div>
                        <h3 id="resultTitle">Seu Estilo Recomendado</h3>
                        <p id="resultDesc">Descrição da sua combinação estilística ideal.</p>
                        <button class="btn btn-gold" onclick="resetQuiz()"><i class="fa-solid fa-rotate-right"></i> Refazer o Teste</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="footer">
        <div class="container footer-content">
            <p>&copy; 2026 Haute Moda Archives. Todos os direitos reservados.</p>
            <p class="footer-sub">Plataforma conectada a uma API Externa de Moda.</p>
        </div>
    </footer>

    <!-- Modal -->
    <div id="showModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div id="modalBody"></div>
        </div>
    </div>

    <!-- SCRIPT DA API E FILTROS EM TEMPO REAL -->
    <script>
        let showsData = [];
        let currentQuizSelection = '';

        const availableYears = [2024, 2021, 2018, 2016, 2014];

        // IMAGENS HD DE ALTA-COSTURA E DESFILES DE LUXO
        const luxuryImages = [
            "https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&w=800&q=80",
            "https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=800&q=80",
            "https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=800&q=80",
            "https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=800&q=80",
            "https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=800&q=80"
        ];

        // Dicionário para traduzir os títulos em inglês da API para Português
        const portTranslations = {
            "mimi dress": "Vestido Midi de Seda Clássica",
            "green chiffon evening dress": "Vestido de Gala em Chiffon Verde",
            "corset evening dress": "Vestido de Noite com Corset de Luxo",
            "corset maxi dress": "Vestido Longo Corset Haute Couture",
            "navy blue evening dress": "Vestido de Gala Azul Marinho",
            "prom dress": "Vestido de Baile Épico",
            "flower girl dress": "Vestido Floral de Passerela",
            "white wedding dress": "Vestido de Noiva Alta-Costura",
            "strapless floral dress": "Vestido Tomara que Caia Floral",
            "casual dress": "Vestido Urbano Chic"
        };

        const locationsPT = [
            "Paris, França",
            "Nova Iorque, EUA",
            "Milão, Itália",
            "Londres, Inglaterra",
            "Tóquio, Japão"
        ];

        // BUSCA DADOS NA API EXTERNA REST
        async function fetchShowsFromAPI() {
            const grid = document.getElementById('showsGrid');
            try {
                const response = await fetch('https://dummyjson.com/products/category/womens-dresses');
                const data = await response.json();

                showsData = data.products.map((item, index) => {
                    const assignedYear = availableYears[index % availableYears.length];
                    const assignedImg = luxuryImages[index % luxuryImages.length];
                    const assignedLocation = locationsPT[index % locationsPT.length];
                    
                    // Tradução dinâmica
                    const titleLower = item.title.toLowerCase();
                    let translatedTitle = "Vestido Exclusivo de Alta-Costura";
                    for (let key in portTranslations) {
                        if (titleLower.includes(key)) {
                            translatedTitle = portTranslations[key];
                            break;
                        }
                    }

                    return {
                        id: item.id,
                        year: assignedYear,
                        location: assignedLocation,
                        theme: translatedTitle,
                        musicalGuests: ["Orquestra de Gala", "Apresentação ao Vivo"],
                        iconicModels: ["Coleção Exclusiva", "Valor estimado: $" + item.price + " USD"],
                        description: "Coleção de luxo apresentada nas passarelas internacionais. Peça de alta-costura desenvolvida com tecidos nobres, acabamento feito à mão e corte impecável.",
                        image: assignedImg
                    };
                });

                renderCatalog(showsData);
                setupFilters();
            } catch (error) {
                console.error("Erro ao carregar os dados da API:", error);
                grid.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: #ff5555; padding: 40px;">Erro ao carregar informações da API em tempo real.</p>`;
            }
        }

        function renderCatalog(items) {
            const grid = document.getElementById('showsGrid');
            if (!grid) return;
            if (items.length === 0) {
                grid.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 40px;">Nenhum desfile ou vestuário encontrado para a sua pesquisa.</p>`;
                return;
            }
            grid.innerHTML = items.map(show => `
                <div class="card">
                    <div>
                        <img src="${show.image}" alt="${show.theme}" class="card-img">
                        <div class="card-header">
                            <span class="card-year">${show.year}</span>
                            <span class="card-location"><i class="fa-solid fa-location-dot"></i> ${show.location}</span>
                        </div>
                        <h3 class="card-theme">${show.theme}</h3>
                        <p class="card-desc">${show.description}</p>
                    </div>
                    <div class="card-footer">
                        <span class="card-models"><i class="fa-solid fa-gem"></i> ${show.iconicModels[1]}</span>
                        <button class="btn btn-outline" style="padding: 6px 14px; font-size: 0.8rem;" onclick="openModal(${show.id})">
                            Ver Mais <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function setupFilters() {
            const searchInput = document.getElementById('searchInput');
            const filterBtns = document.querySelectorAll('.filter-btn');
            let currentFilter = 'all';

            function applyFilters() {
                const query = searchInput.value.toLowerCase().trim();
                
                const filtered = showsData.filter(show => {
                    const matchesSearch = query === '' || 
                                          show.theme.toLowerCase().includes(query) ||
                                          show.location.toLowerCase().includes(query) ||
                                          show.year.toString().includes(query) ||
                                          show.description.toLowerCase().includes(query);
                    
                    const matchesYear = query !== '' || currentFilter === 'all' || show.year.toString() === currentFilter;

                    return matchesSearch && matchesYear;
                });
                renderCatalog(filtered);
            }

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    if (searchInput.value.trim() !== '') {
                        filterBtns.forEach(b => b.classList.remove('active'));
                        const allBtn = document.querySelector('.filter-btn[data-filter="all"]');
                        if (allBtn) allBtn.classList.add('active');
                        currentFilter = 'all';
                    }
                    applyFilters();
                });
            }

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    currentFilter = btn.dataset.filter;
                    if (searchInput) searchInput.value = '';
                    applyFilters();
                });
            });
        }

        function openModal(id) {
            const show = showsData.find(s => s.id === id);
            if (!show) return;
            document.getElementById('modalBody').innerHTML = `
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="${show.image}" style="width: 100%; max-height: 350px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; border: 1px solid var(--border-color);">
                    <br>
                    <span style="color: var(--gold); font-size: 0.9rem; letter-spacing: 2px;">EDIÇÃO DE ${show.year}</span>
                    <h2 style="font-family: var(--font-heading); font-size: 1.8rem; color: #fff; margin-top: 5px;">${show.theme}</h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem;"><i class="fa-solid fa-location-dot"></i> ${show.location}</p>
                </div>
                <p style="margin-bottom: 20px; font-size: 0.95rem; line-height: 1.7; color: var(--text-primary);">${show.description}</p>
                <div style="background-color: var(--bg-main); padding: 15px; border-radius: 6px; border: 1px solid var(--border-color); margin-bottom: 15px;">
                    <h4 style="color: var(--gold); margin-bottom: 8px; font-size: 0.9rem;"><i class="fa-solid fa-gem"></i> Detalhes da Peça:</h4>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">${show.iconicModels.join(' • ')}</p>
                </div>
            `;
            document.getElementById('showModal').style.display = 'flex';
        }

        function closeModal() { document.getElementById('showModal').style.display = 'none'; }
        window.onclick = function(event) { if (event.target === document.getElementById('showModal')) closeModal(); };

        function selectQuizOption(step, choice) {
            currentQuizSelection = choice;
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
        }

        function showQuizResult(colorChoice) {
            document.getElementById('step2').style.display = 'none';
            const resultDiv = document.getElementById('quizResult');
            const title = document.getElementById('resultTitle');
            const desc = document.getElementById('resultDesc');
            resultDiv.style.display = 'block';

            if (currentQuizSelection === 'formal' || colorChoice === 'dourada') {
                title.innerText = "Estilo: Haute Elegance (Alta-Costura)";
                desc.innerText = "A sua presença é marcada por sofisticação refinada, tecidos nobres e tons metálicos.";
            } else if (currentQuizSelection === 'casual' || colorChoice === 'neutra') {
                title.innerText = "Estilo: Minimalista & Quiet Luxury";
                desc.innerText = "Valoriza cortes impecáveis, conforto e elegância discreta.";
            } else {
                title.innerText = "Estilo: Vanguardista & Glamour Urbano";
                desc.innerText = "Não tem medo de arriscar! Adora combinar elementos modernos e cores vibrantes.";
            }
        }

        function resetQuiz() {
            document.getElementById('quizResult').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchShowsFromAPI();
        });
    </script>
</body>
</html>