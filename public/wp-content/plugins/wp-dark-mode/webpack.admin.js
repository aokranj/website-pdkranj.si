const path = require("path"); 

module.exports = {
  entry: "./src/js/admin.js",
  output: {
    path: path.resolve(__dirname, "assets/js"),
    filename: "admin.min.js",
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
  mode: "production",
};
