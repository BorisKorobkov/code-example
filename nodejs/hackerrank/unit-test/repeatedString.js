const assert = require('assert');
const {repeatedString} = require('../src/repeatedString');

describe('repeatedString', () => {

    it('Sample Input 0', () => {
        let output = repeatedString('aba', 10);
        assert.equal(output, 7);
    });

    it('Sample Input 0', () => {
        let output = repeatedString('a', 1000000000000);
        assert.equal(output, 1000000000000);
    });
});