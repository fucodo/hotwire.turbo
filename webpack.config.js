const path = require('path');

module.exports = {
    mode: 'production',
    entry: './Resources/Private/JavaScript/main.js',
    output: {
        path: path.resolve(__dirname, 'Resources/Public/JavaScript'),
        filename: 'bundle.js',
    },
};
