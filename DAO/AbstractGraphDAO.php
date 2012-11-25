<?php
require_once 'AbstractBaseDAO.php';

/**
 * Description of AbstractGraphDAO
 *
 * @author jkachins
 */
abstract class AbstractGraphDAO extends AbstractBaseDAO{
    protected function fillGraphObject(array $arr, GraphObject $obj) {
        $obj->setDescription($arr['Description']);
        $obj->setImage($arr['Image']);
        $obj->setId($arr[$this->getTableName().'ID']);
        $obj->setTitle($arr['Title']);
    }
}

?>
