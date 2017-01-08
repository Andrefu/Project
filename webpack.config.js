module.exports = {
	entry: "./app/assets/scripts/App.js",
	output: {
		path: "./app/temp/scripts",
		filename: "App.js"
	},
	module: {
		loaders: [
			{
				loader: 'babel',
				query: {
					presets: ['es2015']
				},
				test: /\.js$/,  //means that babel will be applied only to .js files
				exclude: /node_modules/  //will exclude the latter folder
			}
		]
	}
}