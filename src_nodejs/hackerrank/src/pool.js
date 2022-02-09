function pool(pool) {
    let volume = 0;

    if (pool.length <= 2) {
        // too small
        return volume;
    }

    let left = 0;
    let right = pool.length - 1;

    let maxLeft = pool[left];
    let maxRight = pool[right];

    left++;
    right--;

    while (left <= right) {
        if (maxLeft <= pool[left]) {
            // climb from left
            maxLeft = pool[left];
            left++;
            continue;
        }

        if (pool[right] >= maxRight) {
            // climb from right
            maxRight = pool[right];
            right--;
            continue;
        }

        if (maxLeft < maxRight) {
            //    ->
            volume += maxLeft - pool[left];
            left++;
            continue;
        }

        //      <-
        volume += maxRight - pool[right];
        right--;
    }

    return volume;
}

module.exports = {pool};