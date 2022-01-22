const assert = require('assert');
const {sockMerchant} = require('../src/sockMerchant');

describe('sockMerchant', () => {

    it('Sample Input', () => {
        let output = sockMerchant(9, [10, 20, 20, 10, 10, 30, 50, 10, 20]);
        assert.equal(output, 3);
    });
});