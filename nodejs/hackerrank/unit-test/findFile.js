const assert = require('assert');
const {findFile} = require('../src/findFile');

describe('findFile', () => {

    it('Sample Input', async () => {
        let output = await findFile('..', '.js');
        console.log(output);
        // assert.equal(output.join('_'), [].join('_'));
    });
});