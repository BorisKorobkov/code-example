// https://habr.com/ru/post/646319/
// complexity O(2n)
// memory O(n)
function carParkingRoof(cars, k) {
    // O(n)
    // object automatically sorts values by numeric keys
    let carsObject = {};
    for (let car of cars) {
        carsObject[car] = null; // key is important, value can be any
    }

    // O(n)
    let queue = [];
    let roofLengthMin = null;
    for (let car in carsObject) {
        car = +car; // str -> int
        queue.push(car);
        if (queue.length === k) {
            let carPrevK = queue.shift();
            let roofLength = car - carPrevK + 1;
            if (roofLengthMin === null) {
                roofLengthMin = roofLength;
            } else {
                roofLengthMin = Math.min(roofLengthMin, roofLength);
            }
        }
    }

    return roofLengthMin;
}

module.exports = {carParkingRoof};