const assert = require('assert');
const {balloon} = require('../src/balloon');

describe('balloon', () => {

    it('Sample Input 1', () => {
        let output = balloon('baonxxoll', 'balloon');
        assert.equal(output, 1);
    });

    it('Sample Input 2', () => {
        let output = balloon('baoollnnololgbax', 'balloon');
        assert.equal(output, 2);
    });

    it('Sample Input 3', () => {
        let output = balloon('qawabawonl', 'balloon');
        assert.equal(output, 0);
    });
});