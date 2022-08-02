/**
 * https://www.hackerrank.com/challenges/new-year-chaos/problem
 *
 * It is New Year's Day and people are in line for the Wonderland rollercoaster ride. Each person wears a sticker indicating their initial position in the queue from  to . Any person can bribe the person directly in front of them to swap positions, but they still wear their original sticker. One person can bribe at most two others.
 * Determine the minimum number of bribes that took place to get to a given queue order. Print the number of bribes, or, if anyone has bribed more than two people, print Too chaotic.
 *
 * Example
 * If person  bribes person , the queue will look like this: . Only  bribe is required. Print 1.
 *
 * Person  had to bribe  people to get to the current position. Print Too chaotic.
 * Function Description
 * Complete the function minimumBribes in the editor below.
 * minimumBribes has the following parameter(s):
 * int q[n]: the positions of the people after all bribes
 *
 * Returns
 * No value is returned. Print the minimum number of bribes necessary or Too chaotic if someone has bribed more than  people.
 *
 * Input Format
 * The first line contains an integer , the number of test cases.
 *
 * Each of the next  pairs of lines are as follows:
 * - The first line contains an integer , the number of people in the queue
 * - The second line has  space-separated integers describing the final state of the queue.
 *
 * Complete the 'minimumBribes' function below.
 *
 * The function accepts INTEGER_ARRAY q as parameter.
 */
function minimumBribes(array) {
    let n = 0;
    let defaultOutput = 'Too chaotic';

    while (array.length) {
        let key = array.length; // starting from "1"
        let value = array.pop();

        if (value > key) {
            throw new Error(`Wrong value ${value}`);
        }

        if (value === key) {
            continue;
        }

        if (key === array[array.length - 1]) {
            // 1 bribe
            n++;
            array[array.length - 1] = value;
            continue;
        }

        if (key === array[array.length - 2]) {
            // 2 bribes
            n += 2;
            array[array.length - 2] = array[array.length - 1];
            array[array.length - 1] = value;
            continue;
        }

        return defaultOutput;
    }

    return n;
}

module.exports = {minimumBribes};