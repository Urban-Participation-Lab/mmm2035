const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  entry: {
    'media-text': './blocks/media-text/index',
  },
  output: {
    path: path.resolve('./blocks'),
    filename: '[name]/dist.js',
  },
};
