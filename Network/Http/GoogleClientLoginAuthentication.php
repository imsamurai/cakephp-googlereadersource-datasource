<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 11.01.2013
 * Time: 15:20:46
 *
 */
class GoogleClientLoginAuthentication {

    const CLIENT_LOGIN_URI = 'https://www.google.com:443/accounts/ClientLogin';

    public static function authentication(HttpSocket $http, &$authInfo) {
        if (isset($authInfo['email'], $authInfo['password'], $authInfo['service'])) {
            $http->request['header']['Authorization'] = self::_generateHeader($http, $authInfo);
            $http->request['header']['Content-type'] = 'application/x-www-form-urlencoded';
        }
    }

    protected static function _generateHeader(HttpSocket $http, &$authInfo) {
        $originalRequest = $http->request;
        $http->configAuth(false);
        $Response = $http->get(static::CLIENT_LOGIN_URI, array(
            "Email" => $authInfo['email'],
            "Passwd" => $authInfo['password'],
            "service" => 'reader'
                ));
        $http->request = $originalRequest;
        $http->configAuth('GoogleClientLogin', $authInfo);

        preg_match("/Auth=(?P<auth>[a-z0-9_\-]+)/i", $Response->body(), $matches_auth);

        return 'GoogleLogin auth=' . $matches_auth['auth'];
    }

}