import miniPressLoader from "./miniPressLoader.js";
import articles_ui from "./articles_ui.js";

class Articles {

    constructor() {
        this.loading = false;
    }

    displayLoader(bool) {
        const loader = document.getElementById('main-loader');
        if (bool) {
            loader.classList.remove('d-none');
        } else {
            loader.classList.add('d-none');
        }
        this.loading = bool;
    }

    load(url, sort = '') {
        if (this.loading) return;
        const articles = document.getElementById('articles-container');
        if (articles) articles.remove();
        this.displayLoader(true);

        miniPressLoader.fetch_miniPress_api(url + sort)
            .then(articles => {
                articles_ui.displayArticles(articles);
                this.displayLoader(false);
            })
            .catch(err => {
                console.log(err);
                this.displayLoader(false);
            });
    }

    loadByAuthor(authorId, sort = '') {
        if (this.loading) return;
        const articles = document.getElementById('articles-container');
        if (articles) articles.remove();
        this.displayLoader(true);

        miniPressLoader.fetchArticlesByAuthor(authorId + sort)
            .then(articles => {
                articles_ui.displayArticles(articles);
                this.displayLoader(false);
            })
            .catch(err => {
                console.log(err);
                this.displayLoader(false);
            });
    }

    loadArticleById(id) {
        if (this.loading) return;
        const articles = document.getElementById('articles-container');
        if (articles) articles.remove();
        this.displayLoader(true);

        miniPressLoader.fetch_miniPress_api(`/api/articles/${id}`)
            .then(articleData => {
                articles_ui.displayFullArticle(articleData.article);
                this.displayLoader(false);
            })
            .catch(err => {
                console.log(err);
                this.displayLoader(false);
            });
    }
}

export default new Articles();