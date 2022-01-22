/**
 * https://www.hackerrank.com/challenges/sock-merchant/problem
 * There is a large pile of socks that must be paired by color. Given an array of integers representing the color of each sock, determine how many pairs of socks with matching colors there are.
 * Complete the 'sockMerchant' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. INTEGER_ARRAY ar
 */
function sockMerchant(n, socks) {
    let oddSocks = new Set();
    let nPairedSocks = 0;
    for (let sock of socks) {

        // pair
        if (oddSocks.has(sock)) {
            oddSocks.delete(sock);
            nPairedSocks++;
            continue;
        }

        // odd
        oddSocks.add(sock);
    }
    return nPairedSocks;
}

module.exports = {sockMerchant};