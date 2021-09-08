const env = (process.env.NODE_ENV || 'development').trim();
if (env === 'development') {
  module.exports = require('./config/webpack.dev.config.js');
} else {
  module.exports = require('./config/webpack.prod.config.js');
}
