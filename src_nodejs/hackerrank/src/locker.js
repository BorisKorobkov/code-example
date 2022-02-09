class Locker {
    // @todo private ('#')
    id = null;
    size = null;
    isFree = true;

    constructor(id, size) {
        this.id = id;
        this.size = size;
    }

    occupy() {
        this.isFree = false;
    }

    free() {
        this.isFree = true;
    }
}

class System {
    // size in cm³
    static LOCKER_SIZE_S = 100;
    static LOCKER_SIZE_M = 300;
    static LOCKER_SIZE_L = 1000;

    #lockers = [];

    addLocker(id, size) {
        this.#lockers.push(new Locker(id, size));
    }

    findFreeLocker(size) {

        /** @type {Locker} */
        let biggerLocker = null;

        for (let locker of this.#lockers) {
            if (!locker.isFree) {
                continue;
            }

            if (locker.size === size) {
                return locker;
            }

            if (locker.size > size &&
                (biggerLocker === null || biggerLocker.size > locker.size)
            ) {
                biggerLocker = locker;
            }
        }

        return biggerLocker;
    }
}


module.exports = {Locker, System};