const assert = require('assert');
const {compositeWords} = require('../src/compositeWords');

describe('compositeWords', () => {

    it('Sample Input', () => {
        let output = compositeWords(['rockstar', 'rock', 'star', 'rocks', 'tar', 'star', 'rockstars', 'super', 'highway', 'high', 'way', 'superhighway']);
        assert.equal(output.join('_'), ['rockstar', 'highway', 'superhighway'].join('_'));
    });
});