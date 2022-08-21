// https://habr.com/ru/post/646319/
// O(n + n*k)
function compositeWords(words) {
    // convert to HashMap. write - O(n), read - O(1), memory - O(n)
    let wordsSet = new Set;
    for (let word of words) {
        wordsSet.add(word);
    }

    // iterate all words. O(n)
    let foundWords = [];
    let isCompositeWordCache = new Map();
    for (let word of wordsSet) {
        let isFound = isCompositeWord(word, 0);
        if (isFound) {
            foundWords.push(word);
        }
    }

    // check word. O(k)
    function isCompositeWord(word, level) {
        if (isCompositeWordCache.has(word)) {
            return isCompositeWordCache.get(word);
        }

        // "level === 0" means "don't compare with itself"
        if (level > 0 && wordsSet.has(word)) {
            return true;
        }

        let prefix = '';
        for (let i = 0; i < word.length - 1; i++) {
            prefix += word[i];

            if (wordsSet.has(prefix)) {
                let postfix = word.slice(i + 1);
                // recursion
                let isFound = isCompositeWord(postfix, level + 1);
                if (isFound) {
                    return true;
                }
            }
        }

        isCompositeWordCache.set(word, false);
        return false;
    }

    return foundWords;
}

module.exports = {compositeWords};
