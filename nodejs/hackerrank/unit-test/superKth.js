const assert = require('assert');
const {superKth} = require('../src/superKth');
const fs = require('fs');

function readArrayFromFile(filename) {
    let stringData = fs.readFileSync(`${__dirname}/${filename}`, {encoding: 'utf8', flag: 'r'});
    return stringData.split(' ').map(aTemp => parseInt(aTemp, 10));
}

describe('superKth', () => {

    it('Sample Input 0', () => {
        /*
        Notice that the first and second subsequences "1 2 5" appear the same;
        they are actually both different because the  in the first subsequence "1" comes from array element a0,
        and the  in the second subsequence comes from array element a2.
        Because , we print the  one () as a single line of space-separated integers.
         */
        let output = superKth(3, [1, 3, 1, 2, 5]);
        assert.equal(output.join(' '), [1, 3, 5].join(' '));
    });

    it('Sample Input 1', () => {
        let output = superKth(2, [1, 3, 2, 4, 5]);
        assert.equal(output.join(' '), [1, 3, 4, 5].join(' '));
    });

    it('Sample Input', () => {
        let output = superKth(1, [9, 2, 10, 3, 11, 4]);
        assert.equal(output.join(' '), [2, 3, 4].join(' '));
    });

    it('Sample Input', () => {
        let output = superKth(2, [10, 22, 9, 33, 21, 50, 41, 60, 80]);
        assert.equal(output.join(' '), [10, 22, 33, 50, 60, 80].join(' '));
    });

    it('Sample Input', () => {
        let output = superKth(1, [3, 2, 6, 4, 5, 1]);
        assert.equal(output.join(' '), [2, 4, 5].join(' '));
    });

    it('Sample Input', () => {
        let output = superKth(1, [10, 9, 8, 6, 5, 4]);
        assert.equal(output.join(' '), [4].join(' '));
    });

    it('Sample Input', () => {
        let output = superKth(1, [3, 10, 2, 1, 20]);
        assert.equal(output.join(' '), [3, 10, 20].join(' '));
    });

    // it('Sample Input 6', () => {
    //     const input = readArrayFromFile('superKth6.input.txt');
    //     const outputExpected = readArrayFromFile('superKth6.output.txt');
    //     let output = superKth(1, input);
    //     assert.equal(output.join(' '), outputExpected.join(' '));
    // });
});