
/**
 * As our first step, we'll pull in the user's webpack.mix.js
 * file. Based on what the user requests in that file,
 * a generic config object will be constructed for us.
 */
let HtmlWebpackPlugin = require('html-webpack-plugin');
let PrerenderSpaPlugin = require('prerender-spa-plugin');


var mix =  require('laravel-mix/setup/webpack.config.js');


mix.plugins.push(
    new HtmlWebpackPlugin({
        template: 'resources/views/index.html',
        inject: false
    })
);
mix.plugins.push(
    new PrerenderSpaPlugin(
        path.join(__dirname, '../../../public'),
        // List of routes to prerender
        ['/']
    )
);

module.exports = mix;