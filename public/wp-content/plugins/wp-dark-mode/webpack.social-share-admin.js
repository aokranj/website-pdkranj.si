const path = require("path"); 

module.exports = {
  entry: "./src/js/social-share-admin.js",
  output: {
    path: path.resolve(__dirname, "assets/js"),
    filename: "social-share-admin.min.js",
  },
  module: {
    rules: [
      {
        test: /\.(js)$/,
        exclude: /node_modules/,
        use: ["babel-loader"],
      },
    ],
  },
  mode: "development",
};
