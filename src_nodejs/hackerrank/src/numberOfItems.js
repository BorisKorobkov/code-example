// https://habr.com/ru/post/646319/
// O(n + n*k)
function numberOfItems(s, startIndices, endIndices) {
    // prepare sums. O(n)
    let itemsCount = []; // [leftIndex, count, rightIndex]
    let leftIndex = null;
    let count = 0;
    for (let i in s) {
        i = +i; // str -> int
        let char = s[i];

        if (char === '*') {
            count++;
            continue;
        }

        // "|"
        if (leftIndex !== null && count > 0) {
            itemsCount.push([leftIndex, count, i]);
        }
        leftIndex = i;
        count = 0;
    }

    // calculate. O(k*n)
    let numberOfItems = [];
    for (let i in startIndices) {
        i = +i; // str -> int
        numberOfItems[i] = 0;
        let startIndex = startIndices[i] - 1;
        let endIndex = endIndices[i] - 1;

        for (let itemCount of itemsCount) {
            if (startIndex <= itemCount[0] && itemCount[2] <= endIndex) {
                numberOfItems[i] += itemCount[1];
                continue;
            }

            break;
        }
    }

    return numberOfItems;
}

module.exports = {numberOfItems};