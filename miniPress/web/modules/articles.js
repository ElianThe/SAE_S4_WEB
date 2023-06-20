import miniPressLoader from "./miniPressLoader.js";
import articles_ui from "./articles_ui.js";

let loading = false;

function displayLoader(bool) {
    const loader = document.getElementById('main-loader');
    if (bool) {
        loader.classList.remove('d-none');
    } else {
        loader.classList.add('d-none');
    }
    loading = bool;
}

function load(url) {
    if (loading) return;
    const articles = document.getElementById('articles-container');
    if (articles) articles.remove();
    displayLoader(true);

    miniPressLoader.fetch_miniPress_api(url)
        .then(articles => {
            // console.log(articles);
            articles_ui.displayArticles(articles);
            displayLoader(false);
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });
}

function loadByAuthor(authorId) {
    if (loading) return;
    const articles = document.getElementById('articles-container');
    if (articles) articles.remove();
    displayLoader(true);

    miniPressLoader.fetchArticlesByAuthor(authorId)
        .then(articles => {
            articles_ui.displayArticles(articles);
            displayLoader(false);
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });
}

function loadArticleById(id) {
    if (loading) return;
    const articles = document.getElementById('articles-container');
    if (articles) articles.remove();
    displayLoader(true);

    miniPressLoader.fetch_miniPress_api(`/api/articles/${id}`)
        .then(articleData => {
            articles_ui.displayFullArticle(articleData.article);  // display full article
            displayLoader(false);
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });
}

export default {
    load,
    loadByAuthor,
    loadArticleById
}