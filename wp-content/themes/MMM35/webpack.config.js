const path = require('path');

module.exports = {
  mode: "production", // "production" | "development" | "none"
  entry: {
    main: "./js/main.js",
  },

  output: {
    path: __dirname,
    filename: "[name].js",
    publicPath: "/wp-content/themes/MMM35/",
  },

  resolve: {
    modules: ['node_modules'],
    alias: {},
  },

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        include: [
          path.resolve(__dirname, "js"),
        ],
        exclude: [
          path.resolve(__dirname, "node_modules")
        ],
        loader: "babel-loader",
        options: {
          presets: ["@babel/preset-env"]
        },
      },
    ],
  },
};
