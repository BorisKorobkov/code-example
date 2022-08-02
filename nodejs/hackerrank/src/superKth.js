/*
https://www.hackerrank.com/challenges/super-kth-lis/problem
Longest Increasing Subsequence (LIS)

Problem Statement :

Given an array of N integers (a0,a1,...,aN-1), find all possible increasing subsequences of maximum length, L.
Then print the lexicographically Kth longest increasing subsequence as a single line of space-separated integers;
if there are less than K subsequences of length L, print -1.

Two subsequences [ap0,ap1,...,apL-1] and [aq0,aq1,...,aqL-1] are considered to be different
if there exists at least one i such that pi != qi.

Input Format

The first line contains 2 space-separated integers, N and K, respectively.
The second line consists of N space-separated integers denoting a0,a1,...,aN-1 respectively.

Constraints

1 <= N <= 10^5
1 <= K <= 10^18
1 <= ai <= N
 */

/*
 * Complete the 'superKth' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts following parameters:
 *  1. LONG_INTEGER k
 *  2. INTEGER_ARRAY a
 */
function superKth(k, a) {
    let subsequences = [];
    let subsequenceMaxLength = 0;
    let subsequenceMaxLengthMinTrailNumber = null;

    function clearSubsequences() {
        subsequences = subsequences.filter(
            function (item) {
                let trialNumber = item[item.length - 1];
                let trialNumberDifference = subsequenceMaxLengthMinTrailNumber - trialNumber;
                return item.length === subsequenceMaxLength ||
                    (item.length + trialNumberDifference >= subsequenceMaxLength);
            }
        );
    }

    function calcMaxLength(subsequence) {
        if (subsequenceMaxLength > subsequence.length) {
            return;
        }

        let trialNumber = subsequence[subsequence.length - 1];

        if (subsequenceMaxLength < subsequence.length) {
            subsequenceMaxLength = subsequence.length;
            subsequenceMaxLengthMinTrailNumber = trialNumber;
            return;
        }

        // subsequenceMaxLength === subsequence.length
        if (subsequenceMaxLengthMinTrailNumber === null || subsequenceMaxLengthMinTrailNumber > trialNumber) {
            subsequenceMaxLengthMinTrailNumber = trialNumber;
        }
    }

    // all elements in a
    for (let currentElement of a) {

        // add to existing subsequences
        let addNewSequence = true;
        for (let subsequence of subsequences) {

            let lastSubsequenceElement = subsequence[subsequence.length - 1];

            if (lastSubsequenceElement < currentElement) {
                // we can add currentElement to the subsequence

                if (lastSubsequenceElement + 1 === currentElement) {
                    // add to the existing subsequence
                    subsequence.push(currentElement);
                    calcMaxLength(subsequence);
                    // clearSubsequences();
                } else {
                    // leave the original subsequence unchanged. Just add currentElement to the duplicated subsequence
                    let subsequenceDuplicated = subsequence.slice(); // duplicate
                    subsequenceDuplicated.push(currentElement); // add currentElement to duplicated subsequence

                    subsequences.push(subsequenceDuplicated); // add duplicated subsequence
                    calcMaxLength(subsequenceDuplicated);
                    clearSubsequences();
                }

                // a new subsequence will be shorter than existing ones
                addNewSequence = false;

            } else if (lastSubsequenceElement === currentElement && subsequence.length > 1) {
                // a new subsequence will be shorter than existing ones
                addNewSequence = false;
            }
        }

        if (!addNewSequence) {
            continue;
        }

        // create a new subsequence from scratch
        subsequences.push([currentElement]);
        calcMaxLength([currentElement]);
        clearSubsequences();
    }

    // remove short subsequences
    let subsequencesWithMaxlength = subsequences.filter(
        (item) => item.length === subsequenceMaxLength
    );
    subsequences = null;

    // doesn't matter to move on
    if (k > subsequencesWithMaxlength.length) {
        return [-1];
    }

    // sort
    subsequencesWithMaxlength.sort(
        function (subsequence1, subsequence2) {
            for (let i in subsequence1) {
                if (subsequence1[i] > subsequence2[i]) {
                    return 1; // the first is bigger
                }
                if (subsequence1[i] < subsequence2[i]) {
                    return -1; // the first is smaller
                }
            }
            return 0; // equal
        }
    );

    // take the k-st subsequence
    return subsequencesWithMaxlength[k - 1];
}

module.exports = {superKth};