const assert = require('assert');
const {carParkingRoof} = require('../src/carParkingRoof');

describe('carParkingRoof', () => {

    it('Sample Input', () => {
        let output = carParkingRoof([6, 2, 12, 7], 3);
        assert.equal(output, 6);
    });

    it('Sample Input', () => {
        let output = carParkingRoof([6, 2, 99999999, 12, 7], 3);
        assert.equal(output, 6);
    });
});