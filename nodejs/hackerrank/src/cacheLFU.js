// Cache with Least Frequently Used (LFU)

class Element {
    /**
     * @property {*}
     */
    #value;

    /**
     * @property {number}
     */
    #counterGet;

    /**
     * @param {*} value
     */
    constructor(value) {
        this.#value = value;
        this.#counterGet = 0;
    }

    /**
     * @return {*}
     */
    getValue() {
        this.#increaseCounter();
        return this.#value;
    }

    /**
     * @return {number}
     */
    getCounter() {
        return this.#counterGet;
    }

    #increaseCounter() {
        this.#counterGet++;
    }
}

class Cache {
    /**
     * @property {number}
     */
    #maxLength;

    /**
     * @property {Map}
     */
    #elements;

    /**
     * @param {number} maxLength
     */
    constructor(maxLength) {
        this.#maxLength = maxLength;
        this.#elements = new Map;
    }

    /**
     * @param {*} key
     * @param {*} value
     */
    set(key, value) {
        if (this.has(key)) {
            // already set - update
            this.#setWithoutCheck(key, value);
            return;
        }

        if (this.#elements.size >= this.#maxLength) {
            // full - delete least frequently used
            let leastFrequentlyUsedKey = this.#getLeastFrequentlyUsedKey();
            if (leastFrequentlyUsedKey) {
                this.delete(leastFrequentlyUsedKey);
            }

            // @todo reset all other counters. It will be LRFU
        }

        this.#setWithoutCheck(key, value);
    }

    /**
     * @param {*} key
     * @param {*} value
     */
    #setWithoutCheck(key, value) {
        this.#elements.set(key, new Element(value));
    }

    /**
     * @param {*} key
     * @return {boolean}
     */
    has(key) {
        return this.#elements.has(key);
    }

    /**
     * @param {*} key
     * @return {*}
     */
    get(key) {
        return this.#elements.get(key)?.getValue();
    }

    /**
     * @param {*} key
     */
    delete(key) {
        this.#elements.delete(key);
    }

    /**
     * @return {number}
     */
    getSize() {
        return this.#elements.size;
    }

    /**
     * @return {*}
     */
    #getLeastFrequentlyUsedKey() {
        let leastFrequentlyUsedKey = null;
        let leastFrequentlyUsedCounter = null;

        for (let [key, element] of this.#elements.entries()) {
            let counter = element.getCounter();
            if (leastFrequentlyUsedCounter === null || leastFrequentlyUsedCounter > counter) {
                leastFrequentlyUsedCounter = counter;
                leastFrequentlyUsedKey = key;
            }
        }

        return leastFrequentlyUsedKey;
    }
}

module.exports = {
    Element,
    Cache
};