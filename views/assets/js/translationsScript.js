
const languageSwitcher = document.getElementById('languageSwitcher');
const currentLanguage = document.getElementById('currentLanguage');
let currentLang = 'es'; // Idioma predeterminado

// Cargar traducciones desde el archivo JSON
async function loadTranslations() {
    const response = await fetch('./translations.json');
    return await response.json();
}

// Actualizar el contenido con el idioma seleccionado
async function updateLanguage(lang) {
    const translations = await loadTranslations();
    const elementsToTranslate = document.querySelectorAll('[data-translate]');

    elementsToTranslate.forEach(el => {
        const key = el.getAttribute('data-translate');
        el.textContent = translations[lang][key];
    });

    // Actualizar el icono del idioma actual
    currentLanguage.textContent = lang.toUpperCase();
}

// Alternar entre idiomas
languageSwitcher.addEventListener('click', () => {
    currentLang = currentLang === 'es' ? 'en' : 'es';
    updateLanguage(currentLang);
});

// Inicializar con el idioma predeterminado
updateLanguage(currentLang);
