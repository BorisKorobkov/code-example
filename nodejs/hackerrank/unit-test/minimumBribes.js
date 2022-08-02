const assert = require('assert');
const {minimumBribes} = require('../src/minimumBribes');

describe('minimumBribes', () => {

    it('Sample Input', () => {
        let output = minimumBribes([1, 2, 3, 5, 4, 6, 7, 8]);
        assert.equal(output, 1);
    });

    it('Sample Input', () => {
        let output = minimumBribes([4, 1, 2, 3]);
        assert.equal(output, 'Too chaotic');
    });

    it('Sample Input 0', () => {
        let output = minimumBribes([2, 1, 5, 3, 4]);
        assert.equal(output, 3);
    });

    it('Sample Input 0', () => {
        let output = minimumBribes([2, 5, 1, 3, 4]);
        assert.equal(output, 'Too chaotic');
    });

    it('Sample Input 1', () => {
        let output = minimumBribes([5, 1, 2, 3, 7, 8, 6, 4]);
        assert.equal(output, 'Too chaotic');
    });

    it('Sample Input 1', () => {
        let output = minimumBribes([1, 2, 5, 3, 7, 8, 6, 4]);
        assert.equal(output, 7);
    });

    it('Sample Input 2', () => {
        let output = minimumBribes([1, 2, 5, 3, 4, 7, 8, 6]);
        assert.equal(output, 4);
    });
});