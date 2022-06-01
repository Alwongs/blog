module.exports = {
    publicPath: process.env.NODE_ENV === "production" ? "/blog/" : "/",
    css: {
        loaderOptions: {
            scss: {
                prependData: '@import "@/assets/styles.scss";'
            }
        }
    }
}