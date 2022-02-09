const assert = require('assert');
const {numberOfItems} = require('../src/numberOfItems');

describe('numberOfItems', () => {

    it('Sample Input', () => {
        let output = numberOfItems('|**|*|*', [1, 1], [5, 6]);
        assert.equal(output.join('_'), [2, 3].join('_'));
    });
});