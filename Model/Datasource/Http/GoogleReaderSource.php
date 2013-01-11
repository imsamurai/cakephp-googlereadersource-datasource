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

    /**
     * Sets credentials data and fetch auth header
     *
     * @param array $credentials
     */
    public function setCredentials(array $credentials = array()) {
        if (empty($credentials['email'])) {
            throw new HttpSourceException('Email not found in credentials');
        }
        if (empty($credentials['password'])) {
            throw new HttpSourceException('Password not found in credentials');
        }

        $credentials += array('service' => 'reader');
        parent::setCredentials($credentials);
    }

    public function beforeRequest($request, $request_method) {
        $this->Http->configAuth('GoogleReaderSource.GoogleClientLogin', $this->credentials);
        return $request;
    }

}