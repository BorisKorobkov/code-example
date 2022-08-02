/**
 * https://www.hackerrank.com/challenges/repeated-string/problem
 * There is a string, , of lowercase English letters that is repeated infinitely many times. Given an integer, , find and print the number of letter a's in the first  letters of the infinite string.
 *
 * Example
 * The substring we consider is , the first  characters of the infinite string. There are  occurrences of a in the substring.
 *
 * Function Description
 * Complete the repeatedString function in the editor below.
 * repeatedString has the following parameter(s):
 * s: a string to repeat
 * n: the number of characters to consider
 * Returns
 * int: the frequency of a in the substring
 *
 * Complete the 'repeatedString' function below.
 *
 * The function is expected to return a LONG_INTEGER.
 * The function accepts following parameters:
 *  1. STRING s
 *  2. LONG_INTEGER n
 */
function repeatedString(s, n) {
    let nA = 0;
    let sLength = s.length;

    let numberOfStringRepetitions = Math.floor(n / sLength);
    let numberOfStringParts = n % sLength;

    if (numberOfStringRepetitions > 0) {
        let nAInString = s.split('a').length - 1;
        nA += nAInString * numberOfStringRepetitions;
    }

   if (numberOfStringParts > 0) {
        let nAInString = s.slice(0, numberOfStringParts).split('a').length - 1;
        nA += nAInString;
    }

    return nA;
}

module.exports = {repeatedString};