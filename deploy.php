<?php

    echo `git submodule update; git pull; git submodule foreach git pull origin master`;

?>