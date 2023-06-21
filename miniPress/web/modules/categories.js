import miniPressLoader from "./miniPressLoader.js";
import categories_ui from "./categories_ui.js";
import articles from "./articles.js";

class Categories {
    displayLoader(bool) {
        const loader = document.getElementById('sidebar-loader');
        if (bool) {
            loader.classList.remove('d-none');
        } else {
            loader.classList.add('d-none');
        }
    }

    load() {
        const categories = document.getElementById('categories-container');
        if (categories) categories.remove();
        this.displayLoader(true);

        return miniPressLoader.fetch_miniPress_api('/api/categories')
            .then(categories => {
                // console.log(categories);
                categories_ui.displayCategories(categories);
                this.displayLoader(false);
                const categoriesLinks = document.getElementsByClassName('category');
                for (let i = 0; i < categories.count; i++) {
                    categoriesLinks[i].addEventListener('click', () => {
                        articles.load(categories.categories[i].links.articles.href);
                    });
                }
            })
            .catch(err => {
                console.log(err);
                this.displayLoader(false);
            });
    }
}

export default new Categories();
