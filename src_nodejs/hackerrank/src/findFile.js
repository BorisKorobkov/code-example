const fs = require('fs/promises');
const path = require('path');

let filePaths = [];

async function findFile(filepath, requiredExtension) {
    const files = await fs.opendir(filepath);
    for await (const file of files) {
        let filename = file.name;
        if (filename === '.' || filename === '..') {
            continue;
        }

        let filepathCurrent = filepath + '/' + filename;
        let extension = path.extname(filename);
        if (extension === requiredExtension) {
            filePaths.push(filepathCurrent);
        }

        if (file.isDirectory()) {
            await findFile(filepathCurrent, requiredExtension);
        }
    }

    return filePaths;
}

module.exports = {findFile};