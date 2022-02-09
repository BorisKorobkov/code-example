const assert = require('assert');
const {pool} = require('../src/pool');

describe('pool', () => {
    it('Sample Input', () => {
        let output = pool([2, 5, 1, 2, 3, 4, 7, 7, 6]);
        assert.equal(output, 10);
    });

    it('Sample Input', () => {
        let output = pool([1, 0, 1]);
        assert.equal(output, 1);
    });

    it('Sample Input', () => {
        let output = pool([5, 0, 5]);
        assert.equal(output, 5);
    });

    it('Sample Input', () => {
        let output = pool([5, 0, 4]);
        assert.equal(output, 4);
    });

    it('Sample Input', () => {
        let output = pool([4, 0, 5]);
        assert.equal(output, 4);
    });

    it('Sample Input', () => {
        let output = pool([4, 0, 5, 0, 2]);
        assert.equal(output, 6);
    });

    it('Sample Input', () => {
        let output = pool([0, 1, 0, 1, 0]);
        assert.equal(output, 1);
    });

    it('Sample Input', () => {
        let output = pool([0, 1, 0, 0, 1, 0]);
        assert.equal(output, 2);
    });

    it('Sample Input', () => {
        let output = pool([4, 2, 2, 1, 1, 1, 3]);
        assert.equal(output, 8);
    });

    it('Sample Input', () => {
        let output = pool([0, 3, 2, 1, 4]);
        assert.equal(output, 3);
    });

    it('Sample Input', () => {
        let output = pool([1, 0, 1, 0]);
        assert.equal(output, 1);
    });

    it('Sample Input', () => {
        let output = pool([1, 0, 1, 2, 0, 2]);
        assert.equal(output, 3);
    });

    it('Sample Input', () => {
        // https://news.ycombinator.com/item?id=6640085
        let output = pool([5, 1, 0, 1]);
        assert.equal(output, 1);
    });

    it('Sample Input', () => {
        // https://news.ycombinator.com/item?id=6640105
        let output = pool([2, 5, 1, 2, 3, 4, 7, 7, 6, 3, 5]);
        assert.equal(output, 12);
    });

    it('Sample Input', () => {
        let output = pool([3, 0, 1, 0, 2]);
        assert.equal(output, 5);
    });
});