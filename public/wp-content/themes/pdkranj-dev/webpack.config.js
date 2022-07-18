const path = require("path");
const webpack = require("webpack");
const FileManagerPlugin = require("filemanager-webpack-plugin");
const CompressionPlugin = require("compression-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const PRODUCTION = process.env.NODE_ENV === "production";

const DIR = path.resolve(__dirname, "..", "pdkranj");

const config = {
  entry: path.resolve(__dirname, "src", "pdkranj.js"),
  output: {
    filename: PRODUCTION ? "pdkranj.min.js" : "pdkranj.js",
    path: path.resolve(__dirname, "public"),
  },
  devtool: PRODUCTION ? "source-map" : "inline-source-map",
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {},
          },
          "css-loader",
          "postcss-loader",
          "sass-loader",
        ],
      },
      {
        test: /\.(woff|woff2|otf)(\?v=\d+\.\d+\.\d+)?$/,
        use: {
          loader: "url-loader",
          options: {
            limit: 10000,
            name: "fonts/[name].[ext]",
          },
        },
      },
      {
        test: /\.(png|jpg|gif|svg)$/,
        use: {
          loader: "url-loader",
          options: {
            limit: 10000,
            name: "images/[name].[ext]",
          },
        },
      },
    ],
  },
  plugins: [
    //new webpack.ProvidePlugin({
    //  $: "jquery",
    //  jQuery: "jquery",
    //}),
    new MiniCssExtractPlugin({
      filename: PRODUCTION ? "pdkranj.min.css" : "pdkranj.css",
    }),
  ],
};

if (PRODUCTION) {
  config.plugins.push(
    new CompressionPlugin({
      //asset: '[path].gz[query]',
      algorithm: "gzip",
      test: /\.(js)$/,
      threshold: 10240,
    }),
    new FileManagerPlugin({
      events: {
        onStart: {
          delete: [
            {
              source: DIR,
              options: {
                force: true,
              },
            },
          ],
        },
        onEnd: {
          copy: [
            { source: "./public", destination: `${DIR}/public` },
            { source: "./inc", destination: `${DIR}/inc` },
            { source: "./tpl", destination: `${DIR}/tpl` },
            { source: "./*.php", destination: `${DIR}` },
            { source: "./style.css", destination: `${DIR}/style.css` },
            { source: "./theme.png", destination: `${DIR}/screenshot.png` },
            { source: "./LICENSE.md", destination: `${DIR}/LICENSE.md` },
            //{ source: "./vendor/**/*", destination: `${targetFolder}/vendor/` },
            //{ source: "./manifest.json", destination: `${targetFolder}/manifest.json` },
          ],
        },
      },
    })
  );
} else {
  config.plugins.push(
    new BrowserSyncPlugin(
      {
        host: "localhost",
        port: 3000,
        proxy: "http://docker.dev.pdkranj.si/",
        files: [
          "./*.php",
          "./inc/**/*.php",
          "./tpl/**/*.php",
          "./templates/**/*.php",
          "./languages/*.po",
          "./public/*.css",
          "./public/*.js",
        ],
      },
      {
        reload: false,
      }
    )
  );
}

module.exports = config;
