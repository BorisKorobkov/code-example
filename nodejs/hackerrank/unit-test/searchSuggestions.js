const assert = require('assert');
const {searchSuggestions} = require('../src/searchSuggestions');

describe('searchSuggestions', () => {

    it('Sample Input', () => {
        let output = searchSuggestions(["mobile", "mouse", "moneypot", "monitor", "mousepad"], "mouse");
        let outputExpected = [
            ["mobile", "moneypot", "monitor"],
            ["mouse", "mousepad"],
            ["mouse", "mousepad"],
            ["mouse", "mousepad"]
        ];
        assert.equal(output.join(' '), outputExpected.join(' '));
    });

    it('Sample Input', () => {
        let output = searchSuggestions(["mobile", "mouse", "moneypot", "monitor", "mousepad"], "sss");
        assert.equal(output.join(' '), [].join(' '));
    });
});