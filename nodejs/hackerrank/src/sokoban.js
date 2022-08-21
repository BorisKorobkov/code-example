const VALUE_EMPTY = 0;
const VALUE_BOX = 1;
const VALUE_WALL = 2;

class Sokoban {
    /** @property {number} */
    #maxX;

    /** @property {number} */
    #maxY;

    /** @property {array} */
    #map;

    /** @property {number} */
    #personX = null;

    /** @property {number} */
    #personY = null;

    constructor(x, y) {
        this.#maxX = x;
        this.#maxY = y;

        // create an empty 2D array
        let line = [];
        for (let j = 0; j < x; j++) {
            line[j] = VALUE_EMPTY;
        }

        this.#map = [];
        for (let i = 0; i < y; i++) {
            this.#map[i] = [...line]; // "this.#map[i] = line;" is wrong! Because it doesn't copy, it creates a link (pointer)
        }
    }

    getMap() {
        return this.#map;
    }

    clearCell(x, y) {
        if (!this.#checkPosition(x, y)) {
            throw Error('Wrong position');
        }
        this.#map[y][x] = VALUE_EMPTY;
    }

    addBox(x, y) {
        if (!this.#checkPosition(x, y)) {
            throw Error('Wrong position');
        }
        this.#map[y][x] = VALUE_BOX;
    }

    addWall(x, y) {
        if (!this.#checkPosition(x, y)) {
            throw Error('Wrong position');
        }
        this.#map[y][x] = VALUE_WALL;
    }

    setPerson(x, y) {
        if (!this.#checkPosition(x, y)) {
            throw Error('Wrong position');
        }
        this.#personX = x;
        this.#personY = y;
    }

    getPerson() {
        return [this.#personX, this.#personY];
    }

    #moveBox(newX, newY, newBoxX, newBoxY) {
        if (!this.#checkPosition(newX, newY)) {
            // external wall
            return false;
        }
        if (this.#map[newY][newX] === VALUE_EMPTY) {
            // empty. We can go
            return true;
        }
        if (this.#map[newY][newX] === VALUE_WALL) {
            // internal wall. We can't go
            return false;
        }

        // box. Try to move the box
        if (!this.#checkPosition(newBoxX, newBoxY)) {
            // external wall
            return false;
        }
        if (this.#map[newBoxY][newBoxX] !== VALUE_EMPTY) {
            // internal wall or other box. Can't move the box
            return false;
        }

        // move the box
        this.clearCell(newX, newY);
        this.addBox(newBoxX, newBoxY);
        return true;
    }

    #movePerson(newX, newY, newBoxX, newBoxY) {
        let isPossible = this.#moveBox(newX, newY, newBoxX, newBoxY);
        if (!isPossible) {
            return false;
        }

        return this.setPerson(newX, newY);
    }

    movePersonRight() {
        return this.#movePerson(this.#personX + 1, this.#personY, this.#personX + 2, this.#personY);
    }

    movePersonLeft() {
        return this.#movePerson(this.#personX - 1, this.#personY, this.#personX - 2, this.#personY);
    }

    movePersonDown() {
        return this.#movePerson(this.#personX, this.#personY + 1, this.#personX, this.#personY + 2);
    }

    movePersonUp() {
        return this.#movePerson(this.#personX, this.#personY - 1, this.#personX, this.#personY - 2);
    }

    #checkPosition(x, y) {
        if (x < 0 || x >= this.#maxX) {
            return false;
        }

        if (y < 0 || y >= this.#maxY) {
            return false;
        }

        return true;
    }
}

module.exports = {Sokoban};
