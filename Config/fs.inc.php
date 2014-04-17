<?php

$fsConfig = array(
    '_atsFs' => array(
        'domain' => 'attachments',
        'class' => 'files',
        'trackers' => 'tcp://172.16.0.5:7777'
    ),
    '_medalFs' => array(
        'domain' => 'glory',
        'class' => 'medal',
        'trackers' => 'tcp://172.16.0.5:7777'
    ),
    '_diskFs' => array(
        'domain' => 'netdisk',
        'class' => 'files',
        'trackers' => 'tcp://172.16.0.5:7777'
    ),
    '_atsUpload' => array(
        'savePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'upload',
        'maxSize' => 2097152,
        'maxWidth' => 0,
        'maxHeight' => 0,
        'override' => 1,
        'mogilefs' => array(
            'domain' => 'attachments',
            'class' => 'files',
            'trackers' => 'http://172.16.0.5:7777'
        )
    ),
    '_imageUpload' => array(
        'savePath' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'upload',
        'maxSize' => 8388608,
        'maxWidth' => 0,
        'maxHeight' => 0,
        'allowedExts' => '*.gif,*.png,*.jpg,*.bmp,*.jpeg',
        'allowedTypes' => 'image/jpeg,image/pjpeg,image/gif,image/png,image/bmp,application/octet-stream',
        'override' => 1,
        'mogilefs' => array(
            'domain' => 'image',
            'class' => 'photo',
            'trackers' => 'http://172.16.0.5:7777'
        )
    ),
    '_medalUpload' => array(
        'savePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'upload',
        'maxSize' => 2097152,
        'maxWidth' => 0,
        'maxHeight' => 0,
        'allowedExts' => '*.gif,*.png,*.jpg,*.bmp',
        'allowedTypes' => 'image/jpeg,image/pjpeg,image/gif,image/png,image/bmp,application/octet-stream',
        'override' => 1,
        'mogilefs' => array(
            'domain' => 'glory',
            'class' => 'medal',
            'trackers' => 'http://172.16.0.5:7777'
        )
    ),
    '_excelUpload' => array(
        'savePath' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'upload',
        'maxSize' => 8388608,
        'maxWidth' => 0,
        'maxHeight' => 0,
        'allowedExts' => '*.xlsx,*.xls',
        'allowedTypes' => 'application/kset',
        'override' => 1,
        'mogilefs' => array(
            'domain' => 'attachments',
            'class' => 'files',
            'trackers' => 'http://172.16.0.5:7777'
        )
    ),
);