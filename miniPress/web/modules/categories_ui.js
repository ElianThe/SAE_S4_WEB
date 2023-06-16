function displayCategories(categories) {
    const categoriesContainer = document.createElement('div');
    categoriesContainer.id = 'categories-container';
    const title = document.createElement('h3');
    title.classList.add('text-decoration-underline');
    title.textContent = 'Catégories';
    categoriesContainer.appendChild(title);

    const categoriesList = document.createElement('ul');
    categoriesList.classList.add('list-group', 'list-group-flush');

    categories.categories.forEach(category => {
        const categoryItem = document.createElement('li');
        categoryItem.classList.add('list-group-item');

        const categoryLink = document.createElement('a');
        categoryLink.href = '#'; // Ajoutez l'URL de la catégorie ici
        categoryLink.classList.add('list-group-link');
        categoryLink.classList.add('link-primary');
        categoryLink.textContent = category.name;

        categoryItem.appendChild(categoryLink);
        categoriesList.appendChild(categoryItem);
    });

    categoriesContainer.appendChild(categoriesList);
    document.getElementById('sidebar').appendChild(categoriesContainer);
}

export default {
    displayCategories
}