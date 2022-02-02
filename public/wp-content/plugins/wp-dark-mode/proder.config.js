module.exports = {
  build: "wp-dark-mode",
  compress: {
    extension: "zip",
    level: "high",
  },
  exclude: [
    ".git",
    ".gitignore",
    "src",
    "node_modules",
    "*.json",
    "*.js",
    ".babelrc",
    "wp-dark-mode.zip",
  ],
};
