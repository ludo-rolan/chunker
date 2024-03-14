const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require("terser-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const devMode = process.env.NODE_ENV !== "production";

plugins = [ 
    new MiniCssExtractPlugin({ filename: "styles.css" }),
    new webpack.HotModuleReplacementPlugin(),
]

let config = {
    mode: "development",
	entry: './index.js',
	output: {
		path: path.resolve(__dirname, './public'),
		filename: './bundle.js'
	},
    plugins,
    devtool: "source-map",
    devServer: {
        contentBase: path.resolve(__dirname, "./public"),
        historyApiFallback: true,
        open: true,
        port: 80,
        hot: true
    },
	module: {
		rules: [
			{
				test: /\.js$/i,
				exclude: /node_modules/,
				loader: 'babel-loader'
			},
            // https://webpack.js.org/loaders/postcss-loader/#autoprefixer
			{
				test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: "css-loader", options: { sourceMap: true } }, 
                    { loader: "sass-loader", options: { sourceMap: true } }, 
                    { loader: "postcss-loader", options: { sourceMap: true } }
                ],
			}
		]
	},
    optimization: {
        minimize: false,
        minimizer: [],
    }
};


if (!devMode) {
    config.optimization.minimize = true
    config.optimization.minimizer = [
        new TerserPlugin({
            test: /\.js(\?.*)?$/i,
            minify: TerserPlugin.uglifyJsMinify,
            // `terserOptions` options will be passed to `uglify-js`
            // Link to options - https://github.com/mishoo/UglifyJS#minify-options
            terserOptions: {},
        }),
        new CssMinimizerPlugin({
            minify: CssMinimizerPlugin.parcelCssMinify,
        })
    ]
}

module.exports = config;
