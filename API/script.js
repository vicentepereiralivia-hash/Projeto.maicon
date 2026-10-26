// BANCO DE DADOS LOCAL DE DESFILES HISTÓRICOS
const showsData = [
    {
        id: 1,
        year: 2024,
        location: "Nova Iorque, EUA",
        theme: "The Tour & O Retorno Oficial",
        musicalGuests: ["Cher", "Tyla", "Lisa (BLACKPINK)"],
        iconicModels: ["Tyra Banks", "Gigi Hadid", "Candice Swanepoel", "Adriana Lima"],
        description: "O grande retorno oficial das passarelas após 6 anos de hiato, celebrando a inclusão, a diversidade e a reunião das supermodelos lendárias da marca."
    },
    {
        id: 2,
        year: 2018,
        location: "Nova Iorque, EUA",
        theme: "Celestial Angels & Mary Katrantzou",
        musicalGuests: ["Shawn Mendes", "The Chainsmokers", "Halsey", "Rita Ora"],
        iconicModels: ["Adriana Lima", "Kendall Jenner", "Bella Hadid", "Elsa Hosk"],
        description: "Marcado pelo emocionante último desfile da supermodelo Adriana Lima e por estampas florais vibrantes criadas em parceria com a estilista Mary Katrantzou."
    },
    {
        id: 3,
        year: 2017,
        location: "Xangai, China",
        theme: "Goddesses & Aventura Nómada",
        musicalGuests: ["Harry Styles", "Miguel", "Jane Zhang"],
        iconicModels: ["Alessandra Ambrosio", "Karlie Kloss", "Bella Hadid"],
        description: "O primeiro grande espetáculo realizado no continente asiático, destacando asas em estilo de deusa grega e a despedida de Alessandra Ambrosio."
    },
    {
        id: 4,
        year: 2016,
        location: "Paris, França",
        theme: "The Road Ahead & Anjos Secretos",
        musicalGuests: ["Lady Gaga", "The Weeknd", "Bruno Mars"],
        iconicModels: ["Bella Hadid", "Gigi Hadid", "Kendall Jenner", "Jasmine Tookes"],
        description: "Apresentado no icónico Grand Palais em Paris. Jasmine Tookes desfilou com o famoso 'Bright Night Fantasy Bra' avaliado em milhões de dólares."
    },
    {
        id: 5,
        year: 2015,
        location: "Nova Iorque, EUA",
        theme: "Boho Hoedown & Fogos de Artifício",
        musicalGuests: ["Selena Gomez", "The Weeknd", "Ellie Goulding"],
        iconicModels: ["Gigi Hadid", "Kendall Jenner", "Adriana Lima", "Lily Aldridge"],
        description: "Edição memorável que marcou a estreia das supermodelos Gigi Hadid e Kendall Jenner na passerela mais famosa da moda."
    },
    {
        id: 6,
        year: 2014,
        location: "Londres, Inglaterra",
        theme: "Gilded Angels & Anjos Dourados",
        musicalGuests: ["Taylor Swift", "Ed Sheeran", "Ariana Grande"],
        iconicModels: ["Adriana Lima", "Alessandra Ambrosio", "Doutzen Kroes"],
        description: "Primeira edição internacional em Londres, notável pela apresentação simultânea de dois 'Dream Angels Fantasy Bras'."
    }
];

let currentQuizSelection = '';

// RENDERIZAR OS CARTÕES DO CATÁLOGO
function renderCatalog(items) {
    const grid = document.getElementById('showsGrid');
    if (!grid) return;

    if (items.length === 0) {
        grid.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 40px;">Nenhum desfile encontrado para a sua pesquisa.</p>`;
        return;
    }

    grid.innerHTML = items.map(show => `
        <div class="card">
            <div>
                <div class="card-header">
                    <span class="card-year">${show.year}</span>
                    <span class="card-location"><i class="fa-solid fa-location-dot"></i> ${show.location}</span>
                </div>
                <h3 class="card-theme">${show.theme}</h3>
                <p class="card-desc">${show.description}</p>
            </div>
            <div class="card-footer">
                <span class="card-models"><i class="fa-solid fa-user-astronaut"></i> ${show.iconicModels.slice(0, 2).join(', ')}...</span>
                <button class="btn btn-outline" style="padding: 6px 14px; font-size: 0.8rem;" onclick="openModal(${show.id})">
                    Ver Mais <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    `).join('');
}

// FILTRAGEM POR ANO E PESQUISA
function setupFilters() {
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');

    let currentFilter = 'all';

    function applyFilters() {
        const query = searchInput.value.toLowerCase();
        const filtered = showsData.filter(show => {
            const matchesSearch = show.theme.toLowerCase().includes(query) ||
                                  show.location.toLowerCase().includes(query) ||
                                  show.year.toString().includes(query) ||
                                  show.iconicModels.some(m => m.toLowerCase().includes(query));
            
            const matchesYear = currentFilter === 'all' || show.year.toString() === currentFilter;

            return matchesSearch && matchesYear;
        });
        renderCatalog(filtered);
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.dataset.filter;
            applyFilters();
        });
    });
}

// MODAL DE DETALHES
function openModal(id) {
    const show = showsData.find(s => s.id === id);
    if (!show) return;

    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = `
        <div style="text-align: center; margin-bottom: 20px;">
            <span style="color: var(--gold); font-size: 0.9rem; letter-spacing: 2px;">EDICAO DE ${show.year}</span>
            <h2 style="font-family: var(--font-heading); font-size: 2rem; color: #fff; margin-top: 5px;">${show.theme}</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;"><i class="fa-solid fa-location-dot"></i> ${show.location}</p>
        </div>

        <p style="margin-bottom: 20px; font-size: 0.95rem; line-height: 1.7; color: var(--text-primary);">${show.description}</p>

        <div style="background-color: var(--bg-main); padding: 15px; border-radius: 6px; border: 1px solid var(--border-color); margin-bottom: 15px;">
            <h4 style="color: var(--gold); margin-bottom: 8px; font-size: 0.9rem;"><i class="fa-solid fa-music"></i> Artistas Convidados:</h4>
            <p style="font-size: 0.88rem; color: var(--text-muted);">${show.musicalGuests.join(' • ')}</p>
        </div>

        <div style="background-color: var(--bg-main); padding: 15px; border-radius: 6px; border: 1px solid var(--border-color);">
            <h4 style="color: var(--gold); margin-bottom: 8px; font-size: 0.9rem;"><i class="fa-solid fa-star"></i> Supermodelos em Destaque:</h4>
            <p style="font-size: 0.88rem; color: var(--text-muted);">${show.iconicModels.join(' • ')}</p>
        </div>
    `;

    document.getElementById('showModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('showModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('showModal');
    if (event.target === modal) {
        closeModal();
    }
};

// QUIZ DE ESTILO
function selectQuizOption(step, choice) {
    currentQuizSelection = choice;
    document.getElementById('step1').classList.remove('active');
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
        desc.innerText = "A sua presença é marcada por sofisticação refinada, tecidos nobres e tons metálicos. Inspira-se nos grandes desfiles de gala e eventos exclusivos.";
    } else if (currentQuizSelection === 'casual' || colorChoice === 'neutra') {
        title.innerText = "Estilo: Minimalista & Quiet Luxury";
        desc.innerText = "Valoriza cortes impecáveis, conforto e elegância discreta. O seu guarda-roupa foca na qualidade dos tecidos e em peças intemporais.";
    } else {
        title.innerText = "Estilo: Vanguardista & Glamour Urbano";
        desc.innerText = "Não tem medo de arriscar! Adora combinar elementos modernos, brilho e cores com as tendências mais recentes das passerelas de todo o mundo.";
    }
}

function resetQuiz() {
    document.getElementById('quizResult').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    document.getElementById('step2').style.display = 'none';
}

// INICIALIZAÇÃO
document.addEventListener('DOMContentLoaded', () => {
    renderCatalog(showsData);
    setupFilters();
});