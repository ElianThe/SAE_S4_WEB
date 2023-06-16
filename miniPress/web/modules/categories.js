import miniPressLoader from "./miniPressLoader.js";
import categories_ui from "./categories_ui.js";

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

    miniPressLoader.fetch_miniPress_api('/categories')
        .then(categories => {
            // console.log(categories);
            categories_ui.displayCategories(categories);
            displayLoader(false);
        })
        .catch(err => {
            console.log(err);
            displayLoader(false);
        });
}

export default {
    load
}