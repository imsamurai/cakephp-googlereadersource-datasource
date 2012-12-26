<?php

/**
 * GoogleReaderSource DataSource
 *
 * DataSource for unofficial google reader api
 *
 */
App::uses('HttpSource', 'HttpSource.Model/Datasource');

class GoogleReaderSource extends HttpSource {

    /**
     * The description of this data source
     *
     * @var string
     */
    public $description = 'GoogleReaderSource DataSource';

}