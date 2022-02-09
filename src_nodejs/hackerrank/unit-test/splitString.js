const assert = require('assert');
const {splitString} = require('../src/splitString');

describe('splitString', () => {

    it('Sample Input', () => {
        let output = splitString('abacdec');
        assert.equal(output, 3);
    });
});