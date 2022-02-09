// https://habr.com/ru/post/648917/
// O(n)
function splitString(word) {
    let characters = new Set();
    for (let i in word) {

        i = +i; // str -> int

        let character = word[i];
        if (characters.has(character)) {
            let postfix = word.slice(i);
            return 1 + splitString(postfix);
        }

        characters.add(character);
    }

    return 1;
}

module.exports = {splitString};