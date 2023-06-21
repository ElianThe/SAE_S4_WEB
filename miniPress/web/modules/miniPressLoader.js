class MiniPressLoader {
    fetch_miniPress_api(url, options) {
        return fetch('http://localhost:5380' + url, options)
            .then(response => {
                if (response.ok) return response.json();
                return Promise.reject(new Error(response.statusText));
            })
            .catch(error => {
                console.log(error);
            });
    }

    fetchArticlesByAuthor(authorId) {
        return this.fetch_miniPress_api(`/api/auteurs/${authorId}/articles`);
    }
}

export default new MiniPressLoader();
