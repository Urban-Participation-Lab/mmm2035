const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  entry: {
    'button': './blocks/button/index',
    'highlight': './blocks/highlight/index',
    'media-text': './blocks/media-text/index',
  },
  output: {
    path: path.resolve('./blocks'),
    filename: '[name]/dist.js',
  },
};
