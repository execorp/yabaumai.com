<?
require_once(dirname(__FILE__) . "/commonObject.class.php");
class blogPostAll extends commonObject {
    var $blogInfo;
    var $title;
    var $contents;
    var $dateTime;

    function setBlogContents($title, $contents, $dateTime) {
        $this->title    = $title;
        $this->contents = $contents;
        $this->dateTime = $dateTime;
    }

    function setBlogInfo($type, $host, $id, $password) {
        $this->blogInfo[$type]['host']     = $host;
        $this->blogInfo[$type]['id']       = $id;
        $this->blogInfo[$type]['password'] = $password;
    }

    function setBlogArticleAll() {
        foreach ($this->blogInfo As $key => $data) {
            $type = $key;
            switch ($type) {
                case 'LD':
                    break;
                case 'AB':
                    break;
                case 'YH':
                    break;
                default:
                    $type = 'RPC';
                    break;
            }
            eval('require_once( dirname(__FILE__) . "/blogManager' . $type . '.class.php" );');
            eval('$blog = new blogManager' . $type . '();');
            $result[$key] = $this->_setBlogArticle($blog, $data);
        }
        return $result;
    }

    function _setBlogArticle($blog, $blogArray) {
        $blog->setBlogConnection($blogArray['host'], $blogArray['id'], $blogArray['password']);
        $dateTime = getDateTime();
        $blog->setBlogContents($this->title, $this->contents, $this->dateTime);
        $result = $blog->postBlog();
        return $result;
    }
}
?>
