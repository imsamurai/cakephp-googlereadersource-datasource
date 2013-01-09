<?php

/**
 * GoogleReaderSource DataSource
 *
 * DataSource for unofficial google reader api
 *
 */
App::uses('HttpSource', 'HttpSource.Model/Datasource');

class GoogleReaderSource extends HttpSource {
    const CLIENT_LOGIN_URI = 'https://www.google.com:443/accounts/ClientLogin';
    /**
     * The description of this data source
     *
     * @var string
     */
    public $description = 'GoogleReaderSource DataSource';

    /**
     * Authorization header
     *
     * @var string
     */
    protected $_authHeader = null;

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

        parent::setCredentials($credentials);
        $Response = $this->Http->post(static::CLIENT_LOGIN_URI, array(
                "Email" => $this->credentials['email'],
                "Passwd" => $this->credentials['password'],
                "service" => 'reader'
            ));

        if (!$Response->isOk()) {
            throw new HttpSourceException('Cant login to Google Reader');
        }

        preg_match("/Auth=(?P<auth>[a-z0-9_\-]+)/i", $Response->body(), $matches_auth);
        $this->_authHeader = $matches_auth['auth'];
    }

    public function addClientLogin($request) {
//        $this->Http->configAuth('GoogleLogin', 'mark', 'secret');
         $request['header']['Authorization'] = 'GoogleLogin auth='.$this -> _authHeader;
         $request['header']['Content-type'] = 'application/x-www-form-urlencoded';

               return $request;
    }

    public function beforeRequest($request, $request_method) {
        return $this->addClientLogin($request);
    }


}