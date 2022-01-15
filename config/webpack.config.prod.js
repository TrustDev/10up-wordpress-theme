const merge = require('webpack-merge');
const TerserPlugin = require('terser-webpack-plugin'); // eslint-disable-line import/no-extraneous-dependencies
const common = require('./webpack.config.common.js');

module.exports = merge(common, {
	mode: 'development'
});
