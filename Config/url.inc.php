<?php

$urlConfig = array('_urls' => array(
        '/^view\/?(\d+)?$/' => array(
                'controller' => 'IndexController',
                'action' => 'viewAction',
        ),
    )
);
