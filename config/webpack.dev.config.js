const merge = require( 'webpack-merge' );
const WebpackCommonConfig = require( './webpack.common.config.js' );
const UglifyJSPlugin = require( 'uglifyjs-webpack-plugin' );
const optimizationConfig = {
  minimizer: [
    new UglifyJSPlugin({
      sourceMap: true,
      cache: true,
      parallel: true,
      uglifyOptions: {
        compress: true,
        mangle: true,
      },
    }),
  ],
};
module.exports = merge( WebpackCommonConfig, {
  mode: 'development',
  devtool: 'source-map',
  optimization: optimizationConfig,
  
});