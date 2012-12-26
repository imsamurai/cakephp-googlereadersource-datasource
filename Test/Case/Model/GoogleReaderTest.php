<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 18.11.2012
 * Time: 22:03:38
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
require_once dirname(__FILE__) . DS . 'models.php';

class GoogleReader extends CakeTestCase {

    /**
     * GoogleReader Model
     *
     * @var GoogleReader
     */
    public $GoogleReader = null;

    public function setUp() {
        parent::setUp();
        $this->_setConfig();
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

    public function testSearch() {
        $this->_loadModel();
//        $this->GoogleReader->setSource('search');
//        $params = array(
//            'fields' => array('mid', 'score'),
//            'conditions' => array(
//                'query' => 'apple'
//            ),
//            'order' => array(
//                'score' => 'asc',
//            ),
//            'limit' => 3
//                );
//
//        $result = $this->GoogleReader->find('all', $params);
//
//        $this->assertCount($params['limit'], $result);
//        $this->assertArrayHasKey('0', $result);
//        $this->assertArrayHasKey($this->GoogleReader->name, $result[0]);
//        $this->assertCount(0, array_diff(array_keys($result[0][$this->GoogleReader->name]), $params['fields']));
    }


}