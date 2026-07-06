// const hamburgerBtn = document.getElementById('hamburgerBtn');
// const menu = document.getElementById('menu');
// let bambooo = document.getElementById('bamboo');
// hamburgerBtn.addEventListener('click', () => {
//     menu.classList.toggle('hidden'); 
//     bambooo.classList.add("text-black");
// });

let html = document.documentElement;
let btn = document.getElementById('toggleBtn'); 
let stored = localStorage.getItem('theme');

let preferDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches; 

function applyTheme(theme) {
    if (theme === 'dark') {
        html.classList.add('dark');
        
    } else {
        html.classList.remove('dark');
        
    }
}

if (stored === 'dark' || stored === 'light') {
    applyTheme(stored);
} else {
    applyTheme(preferDark ? 'dark' : 'light');
}

btn.addEventListener('click', () => {
    let isNowDark = html.classList.toggle('dark');
    const theme = isNowDark ? 'dark' : 'light';
    localStorage.setItem('theme', theme);
    applyTheme(theme);
});