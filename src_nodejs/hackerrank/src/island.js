/**
 * @link https://leetcode.com/problems/max-area-of-island/
 *
 * You are given an m x n binary matrix grid. An island is a group of 1's (representing land) connected 4-directionally (horizontal or vertical.) You may assume all four edges of the grid are surrounded by water.
 * The area of an island is the number of cells with a value 1 in the island.
 * Return the maximum area of an island in grid. If there is no island, return 0.
 * Input: grid = [[0,0,1,0,0,0,0,1,0,0,0,0,0],[0,0,0,0,0,0,0,1,1,1,0,0,0],[0,1,1,0,1,0,0,0,0,0,0,0,0],[0,1,0,0,1,1,0,0,1,0,1,0,0],[0,1,0,0,1,1,0,0,1,1,1,0,0],[0,0,0,0,0,0,0,0,0,0,1,0,0],[0,0,0,0,0,0,0,1,1,1,0,0,0],[0,0,0,0,0,0,0,1,1,0,0,0,0]]
 * Output: 6
 * Explanation: The answer is not 11, because the island must be connected 4-directionally.
 *
 * @param grid
 * @return {number}
 */
function island(grid) {

    let maxIslandSize = 0;
    let gridSet = new Set();

    // from left to right
    for (let rowId in grid) {
        rowId = +rowId;
        let row = grid[rowId];

        // from top to bottom
        for (let cellId in row) {
            cellId = +cellId;
            let cell = row[cellId];
            let rowCellKey = rowId + '_' + cellId;

            if (!cell) {
                // empty. Nothing to calculate
                gridSet.add(rowCellKey);  // add to cache
                continue;
            }

            if (gridSet.has(rowCellKey)) {
                // was calculated already
                continue;
            }

            // calculate
            let islandSize = getIslandSize(rowId, cellId);
            maxIslandSize = Math.max(maxIslandSize, islandSize);
        }
    }

    function getIslandSize(rowId, cellId) {
        let islandSet = new Set();
        let islandSize = 0;
        fillIsland(rowId, cellId);

        function fillIsland(rowId, cellId) {
            let rowCellKey = rowId + '_' + cellId;
            gridSet.add(rowCellKey); // add to cache
            if (islandSet.has(rowCellKey)) {
                // already calculated
                return;
            }

            // mark
            islandSet.add(rowCellKey);
            islandSize++;

            if (grid[rowId] && grid[rowId][cellId + 1] === 1) {
                fillIsland(rowId, cellId + 1); // right
            }

            if (grid[rowId] && grid[rowId][cellId - 1] === 1) {
                fillIsland(rowId, cellId - 1); // left
            }

            if (grid[rowId - 1] && grid[rowId - 1][cellId] === 1) {
                fillIsland(rowId - 1, cellId); // up
            }

            if (grid[rowId + 1] && grid[rowId + 1][cellId] === 1) {
                fillIsland(rowId + 1, cellId); // down
            }
        }

        return islandSize;
    }

    return maxIslandSize;
}

module.exports = {island};