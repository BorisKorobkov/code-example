#!/bin/bash

diff expected.json <(docker run --env-file json.env        boriskorobkov/recipe-count:dev php src/index.php)
diff expected.json <(docker run --env-file json.gz.env     boriskorobkov/recipe-count:dev php src/index.php)
diff expected.json <(docker run --env-file json.tar.gz.env boriskorobkov/recipe-count:dev php src/index.php)
