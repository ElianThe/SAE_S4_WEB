import articles from './modules/articles.js';
import articles_ui from "./modules/articles_ui.js";

function displayLoader(bool) {
    const loader = document.getElementById('loader');
    if (bool) {
        loader.classList.remove('d-none');
    } else {
        loader.classList.add('d-none');
    }
}

document.getElementById('btn_articles').addEventListener('click', () => {
    displayLoader(true);

    articles.load('/articles')
        .then(articles => {
            console.log(articles);
            articles_ui.displayArticles(articles);
            displayLoader(false);
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });

});