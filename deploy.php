<?php

    echo `git submodule update 2>&1; git pull 2>&1; git submodule foreach git pull origin master 2>&1`;

?>