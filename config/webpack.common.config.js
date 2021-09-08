const path = require( 'path' );
const merge = require( 'webpack-merge' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const webpack = require( 'webpack' );
const build = '../dist';
// modules
const modules = {
  rules: [
    // https://webpack.js.org/loaders/eslint-loader/
    {
      enforce: 'pre',
      test: /\.js$/,
      exclude: /node_modules/,
      loader: 'eslint-loader',
      options: {
        fix: true,
        failOnWarning: false,
        failOnError: true,
        emitWarning: true,
      },
    },
    // https://webpack.js.org/loaders/babel-loader/
    {
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
      },
    },
    // Basic stylesheets configure
    {
      test: /\.(sa|sc|c)ss$/,
      enforce: 'pre',
      use: [
      {
        loader: MiniCssExtractPlugin.loader,
        options: {
          publicPath: '../',
          hmr: 'development' === process.env.NODE_ENV,
            // reloadAll: true,
          },
        },
        {
          loader: 'css-loader',
          options: {
            sourceMap: true,
            url: false,
          },
        },
        {
          loader: 'postcss-loader',
          options: {
            sourceMap: 'inline',
            plugins: () => [
            require( 'autoprefixer' ),
            ],
          },
        },
        'sass-loader',
        ],
      },
    // allow loading png and jpeg files
    {
      test: /\.(png|jp(e*)g)$/,
      use: [
      {
        loader: 'url-loader',
        options: {
            imit: 8000, // Convert images < 8kb to base64 strings
            name: 'img/[hash]-[name].[ext]',
          },
        }
        ],
      },
      ],
    };
//  Resolves
//  const resolves = {
//    modules: [
//      path.resolve(__dirname, '../assets'),
//      'node_modules'
//    ]
//  }
// Plugins
const pluginsConfig = [
new webpack.ProgressPlugin(),
new CleanWebpackPlugin(),
new StyleLintPlugin({
  configFile: '.stylelintrc',
  syntax: 'scss',
}),
new MiniCssExtractPlugin({
  filename: '[name].min.css',
  chunkFilename: '[id].min.css',
}),
];
const entryJS = {
  theme: './js/theme.js',
};
const entryCss = {
  main: './src/sass/main.scss',
  editor: './src/sass/style-editor.scss',
};
// Export config
module.exports = {
  target: 'web',
  entry: merge(entryJS, entryCss),
  output: {
    filename: '[name].min.js',
    path: path.resolve(__dirname, build),
  },
  module: modules,
  plugins: pluginsConfig,
  //resolve: resolves,
};