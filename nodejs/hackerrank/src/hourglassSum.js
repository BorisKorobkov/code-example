/**
 * https://www.hackerrank.com/challenges/2d-array/problem
 * Given a  2D Array, :
 * 1 1 1 0 0 0
 * 0 1 0 0 0 0
 * 1 1 1 0 0 0
 * 0 0 0 0 0 0
 * 0 0 0 0 0 0
 * 0 0 0 0 0 0
 *
 * An hourglass in  is a subset of values with indices falling in this pattern in 's graphical representation:
 * a b c
 *   d
 * e f g
 * There are  hourglasses in . An hourglass sum is the sum of an hourglass' values. Calculate the hourglass sum for every hourglass in , then print the maximum hourglass sum. The array will always be .
 *
 * Example
 * -9 -9 -9  1 1 1
 *  0 -9  0  4 3 2
 * -9 -9 -9  1 2 3
 *  0  0  8  6 6 0
 *  0  0  0 -2 0 0
 *  0  0  1  2 4 0
 *
 * The  hourglass sums are:
 * -63, -34, -9, 12,
 * -10,   0, 28, 23,
 * -27, -11, -2, 10,
 *   9,  17, 25, 18
 * The highest hourglass sum is  from the hourglass beginning at row , column :
 *
 * 0 4 3
 *   1
 * 8 6 6
 * Note: If you have already solved the Java domain's Java 2D Array challenge, you may wish to skip this challenge.
 *
 * Function Description
 *
 * Complete the function hourglassSum in the editor below.
 *
 * hourglassSum has the following parameter(s):
 *
 * int arr[6][6]: an array of integers
 * Returns
 *
 * int: the maximum hourglass sum
 * Complete the 'hourglassSum' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts 2D_INTEGER_ARRAY arr as parameter.
 */
function hourglassSum(arr) {
    let maxSum = null;

    // @todo this is bruteforce
    for (let x = 0; x <= 3; x++) {
        for (let y = 0; y <= 3; y++) {
            let sum = arr[y][x] + arr[y][x + 1] + arr[y][x + 2] +
                arr[y + 1][x + 1] +
                arr[y + 2][x] + arr[y + 2][x + 1] + arr[y + 2][x + 2];

            if (maxSum === null) {
                maxSum = sum;
            } else {
                maxSum = Math.max(maxSum, sum);
            }
        }
    }

    return maxSum;
}

module.exports = {hourglassSum};
