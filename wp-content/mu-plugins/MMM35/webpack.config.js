const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  entry: {
    'split-section': './blocks/split-section/index',
  },
  output: {
    path: path.resolve('./blocks'),
    filename: '[name]/dist.js',
  },
};