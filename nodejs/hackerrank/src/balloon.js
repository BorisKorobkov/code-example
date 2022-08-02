// https://habr.com/ru/post/648917/
// O(n + 2k)
function balloon(originalString, substring) {

    // O(n)
    let originalStringCharacters = word2characters(originalString);

    // O(k)
    let substringCharacters = word2characters(substring);

    // O(k)
    let n = null;
    for (let [character, characterCount] of substringCharacters) {
        let originalCharacterCount = originalStringCharacters.has(character) ?
            originalStringCharacters.get(character) :
            0;

        let nTmp = Math.floor(originalCharacterCount / characterCount);
        if (n === null) {
            n = nTmp;
        } else {
            n = Math.min(n, nTmp);
        }

        if (!n) {
            return 0;
        }
    }

    function word2characters(word) {
        let characters = new Map();
        for (let character of word) {
            if (characters.has(character)) {
                characters.set(character, characters.get(character) + 1); // ++
            } else {
                characters.set(character, 1);
            }
        }
        return characters;
    }

    return +n;
}

module.exports = {balloon};