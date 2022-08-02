const assert = require('assert');
const {jumpingOnClouds} = require('../src/jumpingOnClouds');

describe('jumpingOnClouds', () => {

    it('Sample Input', () => {
        let output = jumpingOnClouds([0, 0, 1, 0, 0, 1, 0]);
        assert.equal(output, 4);
    });
});