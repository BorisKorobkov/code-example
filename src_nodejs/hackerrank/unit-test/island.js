const assert = require('assert');
const {island} = require('../src/island');

describe('island', () => {

    it('Sample Input', () => {
        let output = island(
            [
                [0, 0, 1, 1],
                [0, 0, 0, 1],
                [0, 1, 1, 0],
                [0, 1, 0, 0],
                [0, 1, 0, 0],
            ]
        );
        assert.equal(output, 4);
    });

    it('Sample Input', () => {
        let output = island(
            [
                [0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
                [0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
                [0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0],
                [0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0]
            ]
        );
        assert.equal(output, 6);
    });
});