import articlesJS from './articles.js';

function displayArticles(articles) {
    const articlesContainer = document.createElement('div');
    articlesContainer.id = 'articles-container';
    document.getElementById('main').appendChild(articlesContainer);

    // Tri des articles par ordre chronologique inverse
    console.log(articles);
    const sortedArticles = articles.articles.sort((a, b) => {
        return new Date(b.article.created_at) - new Date(a.article.created_at);
    });

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
        titleTd.textContent = article.title;
        tr.appendChild(titleTd);

        const creationDateTd = document.createElement('td');
        creationDateTd.textContent = article.created_at;
        tr.appendChild(creationDateTd);

        const userIdTd = document.createElement('td');
        const authorLink = document.createElement('a');
        authorLink.href = '#';
        authorLink.textContent = article.user_id;
        authorLink.addEventListener('click', (e) => {
            e.preventDefault();
            articlesJS.loadByAuthor(article.user_id);
        });
        userIdTd.appendChild(authorLink);
        tr.appendChild(userIdTd);

        tableBody.appendChild(tr);
    });

    table.appendChild(tableBody);
    articlesContainer.appendChild(table);

    document.getElementById('main').appendChild(articlesContainer);
}


export default {
    displayArticles
}