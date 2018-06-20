<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午9:42
 */

namespace Process;


class VenueManager extends Base
{

    static  $add_venue = "INSERT INTO venue (name) VALUES (?)";

    static $add_space = "INSERT INTO space (name,value) VALUES (?,?)";

    static $check_slot = "SELECT id,name FROM event WHERE space =? AND (start + duration) > ? AND start < ?";

    static $add_event = "INSERT INTO event (name ,space,start,duration) VALUES (?,?,?,?)";

    function addVenue ($name,$space_array){
/*方法 接受两个参数 一个是场所名称  一个是包含多个空间名称的数组

该方法  使用两个参数来为 venue 和space 两个表 赋值

同时 创建了一个包含相关信息的数据结构 每一行数据都有一个新生成的id值

本方法 很多语句 交给 prepareStatement 和 doStatement 方法 但是我们没有捕捉异常

因此 如果出错 我们会看到 抛出异常


创建了场所后 我们遍历$space_array数组 对应每一个数组元素 在space数据表中添加一行记录

注意 我们为每一行新增的记录 添加了一个外键 其值 为VENUE 的ID 这样可以把 space 记录 和 venue 记录 关联起来

*/
        $ret =array();

        $ret['venue'] = array($name);

        $this->doStatement(self::$add_venue,$ret['venue']);

        $v_id = self::$DB -> lastInsertId();

        $ret['spaces']=array();

        foreach ($space_array as $space_name){

            $values = array($space_name,$v_id);

            $this->doStatement(self::$add_space,$values);

            $s_id = self::$DB->lastInsertId();

            array_unshift($values,$s_id);

            $ret['spaces'][] = $values;

        }

        return $ret;



    }

    function bookEvent($space_id,$name,$time,$duration){

        $values = array($space_id,$time,($time+$duration));

        $stmt = $this->doStatement(self::$check_slot,$values,false);

        if ($result = $stmt->fetch()){

        }

        $this->doStatement(self::$add_event,array($name,$space_id,$time,$duration));

    }


}