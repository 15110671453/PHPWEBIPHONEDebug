<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午1:06
 */

namespace Product;


use BasicFirst\CDProduct;
use ChargeInterface\Chargeable;

class ShopProduct implements Chargeable
{
    /*
     * 改进 对子类采取一定的访问控制 将原先属性public 全部进行限定
     * */
    const AVAILABLE = 0;
    const  OUT_OF_STOCK = 1;
    /*上面 是在类中 定义常量成员  和静态属性一样 它们只能通过类来访问 不能通过对象来访问*/
    private $title;
    private $producerMainName;
    private  $producerFirstName;
    protected $price;
    private $discount = 0;
    private  $proID =0;

    public  function messageShow(){

        print ShopProduct::AVAILABLE;

    }
    public function __construct($title,$firstName,$mainName,$price)
    {
        $this->title=$title;
        $this->producerFirstName=$firstName;
        $this->producerMainName=$mainName;
        $this->price=$price;



    }

    /*为进行过访问控制的属性 进行方法的开放调用*/

    public function getProducerFirstName(){

        return $this->producerFirstName;
    }

    function getProducerMainName(){

        return $this->producerMainName;
    }

    public function setDiscount($num){

        $this->discount=$num;
    }

    public function  setProID($id){
        $this->proID=$id;
    }

    public function getDiscount(){

        return $this->discount;
    }

    public  function  getTitle(){

        return $this->title;
    }



    public function  getProducer()
    {
        return "{$this->producerFirstName}"."{$this->producerMainName}";
    }

    public function getSummaryLine(){
        $base = "{$this->title} ( {$this->producerMainName},";

        $base .= "{$this->producerFirstName}";

        return $base;

    }

    public  static  function  getInstance ($id,\PDO $pdo){

        /*你可以通过 PHP 的 phpinfo() 函数来查看是否安装了PDO扩展 需要保证安装*/
      $stmt = $pdo->prepare("select * from products where id = ?");

        $result = $stmt->execute(array($id));

        $row = $stmt->fetch();

        if (empty($row)) {return null;}

        if ($row['type']=="CD")
        {
            $product = new CDProduct($row['title'],$row['firstname'],$row['mainname'],$row['price'],$row['playlength']);


        }

        $product->setDiscount($row['discount']);
        $product->setProID($row['id']);

        return $product;
    }


    /*这里我们 实现 接口interface  Chargeable*/
        /*这里ShopProduct 本来有一个getPrice的方法 那么实现接口这个方法还有用吗？ 答案是肯定的

        因为类型 。 实现接口的类接受了它继承的类以及实现的接口的类型 也就是CDProduct 同时属于

        CDProduct ShopProduct Chargeable
        */
    public function  getPrice(){

        return ($this->price - $this->discount);
    }

}