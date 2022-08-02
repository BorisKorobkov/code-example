const assert = require('assert');
const {countingValleys} = require('../src/countingValleys');

describe('countingValleys', () => {

    it('Sample Input', () => {
        let output = countingValleys(8, 'UDDDUDUU');
        assert.equal(output, 1);
    });
});