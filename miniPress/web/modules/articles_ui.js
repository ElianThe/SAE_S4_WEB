function displayArticles(articles) {
    const articlesContainer = document.createElement('div');
    articlesContainer.id = 'articles-container';
    document.getElementById('main').appendChild(articlesContainer);

    // Tri des articles par ordre chronologique inverse
    const sortedArticles = articles.articles.sort((a, b) => {
        return new Date(b.article.date_creation) - new Date(a.article.date_creation);
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
        titleTd.textContent = article.titre;
        tr.appendChild(titleTd);

        const creationDateTd = document.createElement('td');
        creationDateTd.textContent = article.date_creation;
        tr.appendChild(creationDateTd);

        const userIdTd = document.createElement('td');
        userIdTd.textContent = article.user_id;
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