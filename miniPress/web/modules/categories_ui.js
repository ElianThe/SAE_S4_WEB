function displayCategories(categories) {
    const categoriesContainer = document.createElement('div');
    categoriesContainer.id = 'categories-container';

    const categoriesList = document.createElement('ul');
    categoriesList.classList.add('list-group', 'list-group-flush');

    let categorie;
    categories.categories.forEach(category => {
        categorie = category.category;
        const categoryItem = document.createElement('li');
        categoryItem.classList.add('list-group-item');

        const categoryButton = document.createElement('div');
        const categoryLink = document.createElement('p');
        categoryLink.classList.add('link-primary', 'category', 'm-0');
        categoryLink.style.cursor = 'pointer';
        categoryLink.textContent = categorie.name;
        categoryButton.appendChild(categoryLink);

        categoryItem.appendChild(categoryLink);
        categoriesList.appendChild(categoryItem);
    });

    categoriesContainer.appendChild(categoriesList);
    document.getElementById('sidebar').appendChild(categoriesContainer);
}

export default {
    displayCategories
}