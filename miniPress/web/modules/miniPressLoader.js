function fetch_miniPress_api(url, options) {
    return fetch('http://localhost:5380' + url, options)
        .then(response => {
            if (response.ok) return response.json();
            return Promise.reject(new Error(response.statusText));
        })
        .catch(error => {
            console.log(error);
        });
}

function fetchArticlesByAuthor(authorId) {
    return fetch_miniPress_api(`/api/auteurs/${authorId}/articles`);
}

export default {
    fetch_miniPress_api,
    fetchArticlesByAuthor
}