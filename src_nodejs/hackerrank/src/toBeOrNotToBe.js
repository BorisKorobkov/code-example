// В очень длинной строке найти самую короткую фразу, которая содержит все ключевые слова.
function toBeOrNotToBe(sentence, words) {
    let foundWords = []; // 0 => start index, 1 => Set, 2 => length
    let minLength = null;

    // convert words-array to words-set. It's quicker to search: O(1) instead of O(n)
    let searchableWords = new Set();
    for (let word of words) {
        searchableWords.add(word);
    }

    // convert word-string to word-array. It's easier to iterate
    let originalWords = sentence.split(' '); // @todo all other non-word characters
    for (let originalWordIndex in originalWords) {
        originalWordIndex = +originalWordIndex;
        let originalWord = originalWords[originalWordIndex];

        if (!searchableWords.has(originalWord)) {
            // other word. Ignore it
            continue;
        }

        // append to existing phrases
        for (let foundWord of foundWords) {
            foundWord[1].add(originalWord);
            if (foundWord[1].size === words.length && foundWord[2] === null) {
                // all words are found! finalize
                foundWord[2] = originalWordIndex - foundWord[0];

                if (minLength === null) {
                    minLength = foundWord[2];
                } else {
                    minLength = Math.min(minLength, foundWord[2]);
                }
            }

            if (words.length === foundWord[2]) {
                // N words without gaps. It's always the best solution
                break;
            }
        }

        // add a new phrase
        let tmpSet = new Set();
        tmpSet.add(originalWord)
        foundWords.push([originalWordIndex, tmpSet, null]);
    }

    // @todo remove elements with the same [1], but lowest [0]. It never can be the shortest phrase

    if (minLength === null) {
        // not found
        return '';
    }

    // find a phrase with minimum length
    for (let foundWord of foundWords) {
        if (foundWord[2] !== minLength) {
            continue;
        }

        return originalWords.slice(foundWord[0], foundWord[0] + foundWord[2] + 1) // "+1" because, the second param is not included
            .join(' ');
    }

    throw Error('Something is wrong');
}

module.exports = {toBeOrNotToBe};