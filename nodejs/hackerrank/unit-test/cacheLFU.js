const assert = require('assert');
const {Element, Cache} = require('../src/cacheLFU');

describe('CacheFLU', () => {

    describe('Element', () => {
        it('should increase counter after getValue()', () => {
            let element = new Element('a');
            assert.equal(element.getCounter(), 0);

            assert.equal(element.getValue(), 'a');
            assert.equal(element.getCounter(), 1);

            assert.equal(element.getValue(), 'a');
            assert.equal(element.getCounter(), 2);
        });
    });

    describe('Cache', () => {

        it('should set and get', () => {
            let cache = new Cache(2);

            cache.set('a', 'aa');
            let aValue = cache.get('a');
            assert.strictEqual(aValue, 'aa');
        });

        it('should overwrite the same key', () => {
            let cache = new Cache(2);
            assert.strictEqual(cache.getSize(), 0);

            cache.set('a', 'aa');
            assert.strictEqual(cache.getSize(), 1);

            cache.set('a', 'ab');
            assert.strictEqual(cache.getSize(), 1);
        });

        it('should add another key', () => {
            let cache = new Cache(2);

            cache.set('a', 'aa');
            assert.strictEqual(cache.getSize(), 1);

            cache.set('b', 'bb');
            assert.strictEqual(cache.getSize(), 2);
        });

        it('should return undefined for non-exist key', () => {
            let cache = new Cache(2);

            let dValue = cache.get('d');
            assert.strictEqual(dValue, undefined);
        });

        it('should drop Least Frequently Used element (a)', () => {
            let cache = new Cache(2);

            // counter = 2
            cache.set('a', 'aa');
            cache.get('a');
            cache.get('a');

            // counter = 3
            cache.set('b', 'bb');
            cache.get('b');
            cache.get('b');
            cache.get('b');

            cache.set('c', 'cc');

            // 'a' should be deleted
            let aValue = cache.get('a');
            assert.strictEqual(aValue, undefined);

            // 'b' should exist
            let bValue = cache.get('b');
            assert.strictEqual(bValue, 'bb');

            // 'c' should exist
            let cValue = cache.get('c');
            assert.strictEqual(cValue, 'cc');
        });

        it('should drop Least Frequently Used element (b)', () => {
            let cache = new Cache(2);

            // counter = 3
            cache.set('a', 'aa');
            cache.get('a');
            cache.get('a');
            cache.get('a');

            // counter = 2
            cache.set('b', 'bb');
            cache.get('b');
            cache.get('b');

            cache.set('c', 'cc');

            // 'a' should exist
            let aValue = cache.get('a');
            assert.strictEqual(aValue, 'aa');

            // 'b' should be deleted
            let bValue = cache.get('b');
            assert.strictEqual(bValue, undefined);

            // 'c' should exist
            let cValue = cache.get('c');
            assert.strictEqual(cValue, 'cc');
        });
    });
});
