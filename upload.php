<?php
require_once 'config/database.php';
$belgesor = $db->prepare("select * from pdf");
$belgesor -> execute();
/**
 *
 */
class Upload
{
  private $dosya;
  public $yuklenendosya;
  function __construct($param)
  {
    $this->dosya=$param;
  }
  private function dosyaisim(){
    $uzantiad = explode(".",$this->dosya['name']);
    $dosya_ad = "";
    for ($i=0; $i <count($uzantiad)-1 ; $i++) {
    $dosya_ad = $dosya_ad ."".$uzantiad[$i]." ";
    }
    return $dosya_ad;

  }
  private function uzanti(){
    $uzantiad = explode(".",$this->dosya['name']);
    $gelenformat = $this->dosya['type'];
    $dosyaformati = array( "image/pjpeg", "image/jpeg", "image/gif", "image/bmp", "image/x-png", "image/png" , "application/pdf", "application/doc", "application/docx", "application/xls", "application/xlsx");
    if (in_array($gelenformat, $dosyaformati)) {
    $dosya_uzanti = $uzantiad[count($uzantiad)-1];
    return $dosya_uzanti;
  }
}
  private function deger(){
    $zaman = time();
    $random = rand(1,10000);
    $kimlik =uniqid();

    $sonuc = $zaman ."_".$random ."_".$kimlik;
    return $sonuc;
  }
  public function temizle($param){
    $bul	= array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', 'Ö', 'İ', 'Ü', '-');
    $degistir = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'o', 'i', 'u', ' ');
    $param = str_replace($bul, $degistir, $param);
    $param = strtolower($param);
    return $param;
  }
  public function yukle($dosyayol=""){
    $dosyaisim =$this->dosyaisim();
    $uzanti = $this->uzanti();
    $yeni_isim=$this->temizle($dosyaisim);
    $son_isim=$yeni_isim .".".$uzanti;
    $son=$dosyayol ."". $son_isim;
    $yukle =move_uploaded_file($this->dosya["tmp_name"],$son);

    if ($yukle) {
      $this->yuklenendosya=$son_isim;
      return true;
              $yukle= new Upload($_FILES['dosya']);

    }else {
      return false;
    }
       }
  
     }




 ?>
