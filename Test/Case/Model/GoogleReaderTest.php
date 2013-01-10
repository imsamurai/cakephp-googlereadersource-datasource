<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 18.11.2012
 * Time: 22:03:38
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
require_once dirname(__FILE__) . DS . 'models.php';

class GoogleReaderTest extends CakeTestCase {

    /**
     * GoogleReader Model
     *
     * @var GoogleReader
     */
    public $GoogleReader = null;

    /**
     * Specify your credentials
     *
     * @var array
     */
    private $_credentials = array();

    public function setUp() {
        parent::setUp();
        $this->_setConfig();
        $this->_credentials = Configure::read('GoogleReaderSourceTest.credentials');
    }

    protected function _setConfig() {
        Configure::delete('GoogleReaderSource');
        Configure::load('GoogleReaderSource.GoogleReaderSource');
    }

    protected function _loadModel($config_name = 'googleReaderSource') {
        $db_configs = ConnectionManager::enumConnectionObjects();

        if (!empty($db_configs['googleReaderTest'])) {
            $TestDS = ConnectionManager::getDataSource('googleReaderTest');
            $config = $TestDS->config;
        } else {
            $config = array(
                'datasource' => 'GoogleReaderSource.Http/GoogleReaderSource',
                'host' => 'www.google.com/reader/api/0',
                'port' => 80,
                'timeout' => 5
            );
        }

        ConnectionManager::create($config_name, $config);
        $this->GoogleReader = new GoogleReader(false, null, $config_name);
    }

    public function testTagList() {
        $this->_loadModel();
        $this->GoogleReader->setSource('tag/list');
        $this->GoogleReader->setCredentials($this->_credentials);
        $params = array(
            'fields' => array('id', 'sortid'),
            'limit' => 3
        );

        $result = $this->GoogleReader->find('all', $params);
        debug($result);

        $this->assertLessThanOrEqual($params['limit'], count($result));
        $this->assertArrayHasKey('0', $result);
        $this->assertArrayHasKey($this->GoogleReader->name, $result[0]);
        $this->assertCount(0, array_diff(array_keys($result[0][$this->GoogleReader->name]), $params['fields']));
    }

    public function testSubscriptionList() {
        $this->_loadModel();
        $this->GoogleReader->setSource('subscription/list');
        $this->GoogleReader->setCredentials($this->_credentials);
        $params = array(
            'fields' => array('id', 'title', 'categories', 'sortid', 'firstitemmsec', 'htmlUrl'),
            'conditions' => array('order' => 'd'),
            'limit' => 3
        );

        $result = $this->GoogleReader->find('all', $params);
        debug($result);

        $this->assertLessThanOrEqual($params['limit'], count($result));
        $this->assertArrayHasKey('0', $result);
        $this->assertArrayHasKey($this->GoogleReader->name, $result[0]);
        $this->assertCount(0, array_diff(array_keys($result[0][$this->GoogleReader->name]), $params['fields']));
    }

}