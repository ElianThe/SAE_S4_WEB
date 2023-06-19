import miniPressLoader from "./miniPressLoader.js";
import categories_ui from "./categories_ui.js";
import articles from "./articles.js";

function displayLoader(bool) {
    const loader = document.getElementById('sidebar-loader');
    if (bool) {
        loader.classList.remove('d-none');
    } else {
        loader.classList.add('d-none');
    }
}

function load() {
    const categories = document.getElementById('categories-container');
    if (categories) categories.remove();
    displayLoader(true);

    return miniPressLoader.fetch_miniPress_api('/api/categories')
        .then(categories => {
            // console.log(categories);
            categories_ui.displayCategories(categories);
            displayLoader(false);
            const categoriesLinks = document.getElementsByClassName('category');
            for (let i = 0; i < categories.count; i++) {
                categoriesLinks[i].addEventListener('click', () => {
                    articles.load(categories.categories[i].links.articles.href);
                });
            }
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });
}

export default {
    load
}