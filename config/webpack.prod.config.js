
const merge = require( 'webpack-merge' );
const UglifyJSPlugin = require( 'uglifyjs-webpack-plugin' );
const WebpackCommonConfig = require( './webpack.common.config.js' );
const optimizationConfig = {
  minimizer: [
    new UglifyJSPlugin({
      sourceMap: false,
      cache: false,
      parallel: true,
      uglifyOptions: {
        compress: true,
        mangle: true,
      },
    }),
  ],
};
module.exports = merge( WebpackCommonConfig, {
  mode: 'production',
  optimization: optimizationConfig,
  
});
