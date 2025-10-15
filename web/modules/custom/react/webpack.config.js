const path = require('path');

const config = {
  entry: {
    main: './js/src/index.jsx'
  },
  devtool: 'source-map',
  mode: 'production',  // Changed from development to production
  output: {
    path: path.resolve(__dirname, "js/dist"),
    filename: '[name].min.js'
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        include: path.join(__dirname, 'js/src'),
        options: {
          presets: ['@babel/preset-env', '@babel/preset-react']
        }
      }
    ],
  },
  optimization: {
    minimize: true
  }
};

module.exports = config;