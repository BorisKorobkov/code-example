const assert = require('assert');
const {Sokoban} = require('../src/sokoban');

describe('Sokoban', () => {

    it('Sample Input', () => {
        let sokoban = new Sokoban(10, 5);

        sokoban.addWall(0, 1);
        sokoban.addWall(1, 1);
        sokoban.addWall(2, 1);
        sokoban.addWall(3, 1);

        sokoban.addBox(1, 0);
        sokoban.addBox(1, 3);

        sokoban.setPerson(1, 4); // 1,4

        sokoban.movePersonRight(); // 1,4 -> 2,4
        assert.equal(sokoban.getPerson().join('_'), '2_4');

        sokoban.movePersonUp(); // 2,4 -> 2,3
        assert.equal(sokoban.getPerson().join('_'), '2_3');

        sokoban.movePersonLeft(); //  // 2,3 -> 1,3 and move the box 1,3 -> 0,3
        assert.equal(sokoban.getPerson().join('_'), '1_3');

        sokoban.movePersonLeft(); // can't move  1,3 -> 0,3, because can't move the box 0,3 -> -1,3
        assert.equal(sokoban.getPerson().join('_'), '1_3');
    });
});