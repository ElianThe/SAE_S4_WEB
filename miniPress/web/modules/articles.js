import miniPressLoader from "./miniPressLoader.js";

function load(url) {
    return miniPressLoader.fetch_miniPress_api(url)
        .then(data => {
            return data;
        });
}

export default {
    load
}