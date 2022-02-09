/*
 * Complete the 'searchSuggestions' function below.
 *
 * The function is expected to return a 2D_STRING_ARRAY.
 * The function accepts following parameters:
 *  1. STRING_ARRAY repository
 *  2. STRING customerQuery
 */

function searchSuggestions(repository, customerQuery) {
    const MIN_LENGTH = 2;
    const MAX_SUGGESTIONS = 3;

    if (customerQuery.length < MIN_LENGTH) {
        return [];
    }

    // lower case
    customerQuery = customerQuery.toLowerCase();
    repository = repository.map(
        function (word) {
            return word.toLowerCase();
        }
    );

    function getSuggestionsForOnePhrase(phrase) {
        // filter
        let repositoryFiltered = repository.filter(
            function (word) {
                return word.startsWith(phrase);
            }
        );

        // sort
        repositoryFiltered.sort();

        // limit
        let repositoryFilteredSortedSliced = repositoryFiltered.slice(0, MAX_SUGGESTIONS);

        return repositoryFilteredSortedSliced;
    }

    let output = [];
    let phrase = '';

    // iterate all sub-words 2 or more characters
    for (let char of customerQuery) {
        phrase += char;
        if (phrase.length < MIN_LENGTH) {
            continue;
        }

        let suggestion = getSuggestionsForOnePhrase(phrase);
        if (suggestion.length) {
            output.push(suggestion);
        }
    }

    return output;
}

module.exports = {searchSuggestions};