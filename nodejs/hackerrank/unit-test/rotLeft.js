const assert = require('assert');
const {rotLeft} = require('../src/rotLeft');

describe('rotLeft', () => {

    it('Sample Input', () => {
        let output = rotLeft([1, 2, 3, 4, 5], 4);
        assert.equal(output.join(' '), [5, 1, 2, 3, 4].join(' '));
    });
});