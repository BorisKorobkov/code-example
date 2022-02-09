const assert = require('assert');
const {toBeOrNotToBe} = require('../src/toBeOrNotToBe');

describe('toBeOrNotToBe', () => {

    it('Sample Input', () => {
        let output = toBeOrNotToBe('to be or not to be what is a question', ['question', 'to', 'be']);
        assert.equal(output, 'to be what is a question');
    });
});