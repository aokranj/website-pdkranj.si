const path = require("path"); 

module.exports = {
  entry: "./src/js/social-share.js",
  output: {
    path: path.resolve(__dirname, "assets/js"),
    filename: "social-share.min.js",
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
