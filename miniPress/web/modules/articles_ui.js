import articlesJS from './articles.js';

class ArticlesUI {
    constructor() {
        this.searchInput = document.getElementById('search-input');
        if (!this.searchInput) {
            this.searchInput = document.createElement('input');
            this.searchInput.type = "text";
            this.searchInput.id = "search-input";
            this.searchInput.placeholder = "Entrez un mot-clé...";
            document.getElementById('main').appendChild(this.searchInput);
        }

        this.originalArticles = [];
    }

    displayArticles(articles, filter = false) {
        if(!filter) {
            this.originalArticles = articles; // Save a copy of the articles
        }
        const articlesContainer = document.createElement('div');
        articlesContainer.id = 'articles-container';
        document.getElementById('main').appendChild(articlesContainer);

        const searchContainer = document.createElement('div');
        searchContainer.classList.add('search-container');

        const searchLabel = document.createElement('label');
        searchLabel.textContent = "Rechercher dans le titre ou le résumé: ";
        searchContainer.appendChild(searchLabel);

        this.searchInput.addEventListener('input', (event) => {
            const keyword = event.target.value;
            const filteredArticles = this.originalArticles.articles.filter(article => { // Use the original articles for filtering
                return article.article.title.includes(keyword) || article.article.summary.includes(keyword);
            });
            // Remove current articles before displaying the new ones
            const currentArticlesContainer = document.getElementById('articles-container');
            if (currentArticlesContainer) currentArticlesContainer.remove();
            this.displayArticles({articles: filteredArticles}, true);
        });

        articlesContainer.appendChild(searchContainer);

        // Tri des articles par ordre chronologique inverse
        const sortedArticles = articles.articles.sort((a, b) => {
            return new Date(b.article.created_at) - new Date(a.article.created_at);
        });

        const sortContainer = document.createElement('div');

        const sortLabel = document.createElement('label');
        sortLabel.textContent = "Trier par : ";
        sortContainer.appendChild(sortLabel);

        const sortSelect = document.createElement('select');
        sortSelect.id = 'sort';

        const sortOptions = [
            { value: '', text: 'Aucun' },
            { value: '?sort=date-asc', text: 'Date de publication croissante' },
            { value: '?sort=date-desc', text: 'Date de publication décroissante' },
            { value: '?sort=auteur', text: 'Auteur' },
        ];
        sortOptions.forEach(optionData => {
            const option = document.createElement('option');
            option.value = optionData.value;
            option.textContent = optionData.text;
            sortSelect.appendChild(option);
        });

        sortSelect.addEventListener('change', (event) => {
            const sort = event.target.value;
            articlesJS.load('/api/articles', sort);
        });

        sortContainer.appendChild(sortSelect);

        articlesContainer.appendChild(sortContainer);

        const table = document.createElement('table');
        table.classList.add('table', 'table-striped');

        const tableHead = document.createElement('thead');
        const tableHeadRow = document.createElement('tr');
        const tableHeaders = ['Titre', 'Date de création', 'Auteur'];

        tableHeaders.forEach(headerText => {
            const th = document.createElement('th');
            th.scope = 'col';
            th.textContent = headerText;
            tableHeadRow.appendChild(th);
        });

        tableHead.appendChild(tableHeadRow);
        table.appendChild(tableHead);

        const tableBody = document.createElement('tbody');

        let article;
        sortedArticles.forEach(art => {
            article = art.article;
            const tr = document.createElement('tr');

            const titleTd = document.createElement('td');
            const titleLink = document.createElement('a');
            titleLink.href = '#';
            titleLink.textContent = article.title;
            titleLink.addEventListener('click', (e) => {
                e.preventDefault();
                articlesJS.loadArticleById(article.id);
            });
            titleTd.appendChild(titleLink);
            tr.appendChild(titleTd);

            const creationDateTd = document.createElement('td');
            creationDateTd.textContent = article.created_at;
            tr.appendChild(creationDateTd);

            const userIdTd = document.createElement('td');
            const authorLink = document.createElement('a');
            authorLink.href = '#';
            authorLink.textContent = article.user.email;
            authorLink.addEventListener('click', (e) => {
                e.preventDefault();
                articlesJS.loadByAuthor(article.user.id);
            });
            userIdTd.appendChild(authorLink);
            tr.appendChild(userIdTd);

            tableBody.appendChild(tr);
        });

        table.appendChild(tableBody);
        articlesContainer.appendChild(table);

        document.getElementById('main').appendChild(articlesContainer);
    }

    displayFullArticle(article) {
        const articlesContainer = document.createElement('div');
        articlesContainer.id = 'articles-container';
        document.getElementById('main').appendChild(articlesContainer);

        const title = document.createElement('h2');
        title.textContent = article.title;
        articlesContainer.appendChild(title);

        const createdAt = document.createElement('p');
        createdAt.textContent = article.created_at;
        articlesContainer.appendChild(createdAt);

        // Convert markdown to HTML
        const showdown = require('showdown');
        const converter = new showdown.Converter();
        const markdownContent = article.content;
        const htmlContent = converter.makeHtml(markdownContent);

        // Append HTML content to the container
        const contentDiv = document.createElement('div');
        contentDiv.innerHTML = htmlContent;
        articlesContainer.appendChild(contentDiv);

        document.getElementById('main').appendChild(articlesContainer);
    }
}

export default new ArticlesUI();
