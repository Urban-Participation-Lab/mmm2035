const path = require('path');

module.exports = {
  mode: "production", // "production" | "development" | "none"
  // Chosen mode tells webpack to use its built-in optimizations accordingly.
  entry: [
    "./js/3d.js",
  ],

  output: {
    path: __dirname,
    filename: "[name].js",
    publicPath: "/assets/", // string
  },

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        include: [
          path.resolve(__dirname, "js")
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
