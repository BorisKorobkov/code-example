const assert = require('assert');
const {System} = require('../src/locker');

describe('locker', () => {

    it('Sample Input', () => {
        let system = new System();

        system.addLocker(31, System.LOCKER_SIZE_L);

        system.addLocker(21, System.LOCKER_SIZE_M);
        system.addLocker(22, System.LOCKER_SIZE_M);

        system.addLocker(11, System.LOCKER_SIZE_S);
        system.addLocker(12, System.LOCKER_SIZE_S);

        /** @type {Locker} */
        let locker1 = system.findFreeLocker(System.LOCKER_SIZE_M);
        assert.notEqual(locker1, null);
        assert.equal(locker1.id, 21);
        assert.equal(locker1.isFree, true);

        locker1.occupy();

        /** @type {Locker} */
        let locker2 = system.findFreeLocker(System.LOCKER_SIZE_M);
        assert.notEqual(locker2, null);
        assert.equal(locker2.id, 22);
        assert.equal(locker2.isFree, true);

        locker2.occupy();

        /** @type {Locker} */
        let locker3 = system.findFreeLocker(System.LOCKER_SIZE_M);
        assert.notEqual(locker3, null);
        assert.equal(locker3.id, 31);
        assert.equal(locker3.isFree, true);
    });
});