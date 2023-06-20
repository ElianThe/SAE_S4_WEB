import categories from './modules/categories.js';
import articles from './modules/articles.js';

document.addEventListener('DOMContentLoaded', () => {
    categories.load();
    articles.load('/api/articles');

});