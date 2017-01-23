module.exports = {
	entry: {
		App: "./app/assets/scripts/App.js",
		Vendor: "./app/assets/scripts/Vendor.js"
	},
	output: {
		path: "./app/temp/scripts",
		filename: "[name].js" // the [name] element will keep the final file name dynamic 
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