const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  entry: {
    viewer: './blocks/viewer/index',
  },
  output: {
    path: path.resolve('./blocks'),
    filename: '[name]/[name].js',
  },
};
