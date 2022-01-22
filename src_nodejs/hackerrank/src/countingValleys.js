/**
 * https://www.hackerrank.com/challenges/counting-valleys/problem
 *
 * An avid hiker keeps meticulous records of their hikes. During the last hike that took exactly  steps, for every step it was noted if it was an uphill, , or a downhill,  step. Hikes always start and end at sea level, and each step up or down represents a  unit change in altitude. We define the following terms:
 *
 * A mountain is a sequence of consecutive steps above sea level, starting with a step up from sea level and ending with a step down to sea level.
 * A valley is a sequence of consecutive steps below sea level, starting with a step down from sea level and ending with a step up to sea level.
 * Given the sequence of up and down steps during a hike, find and print the number of valleys walked through.
 *
 * Example
 *
 * The hiker first enters a valley  units deep. Then they climb out and up onto a mountain  units high. Finally, the hiker returns to sea level and ends the hike.
 *
 * Function Description
 *
 * Complete the countingValleys function in the editor below.
 *
 * countingValleys has the following parameter(s):
 *
 * int steps: the number of steps on the hike
 * string path: a string describing the path
 * Returns
 *
 * int: the number of valleys traversed
 *
 * Complete the 'countingValleys' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER steps
 *  2. STRING path
 */
function countingValleys(steps, path) {
    let nValleys = 0;
    let prevHeight = 0;
    let currentHeight = 0;

    for (let step of path) {
        let difference = step === 'D' ? -1 : 1;
        currentHeight += difference;
        if (prevHeight === 0 && currentHeight === -1) {
            // we're starting to go down below sea level
            nValleys++;
        }
        prevHeight = currentHeight;
    }

    return nValleys;
}

module.exports = {countingValleys};