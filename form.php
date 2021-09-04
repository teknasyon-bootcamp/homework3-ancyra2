<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */

Class Form {

    private array $fields; // Html form elemanlarının değerlerini tutan dizi

    private function __construct( //$action ve $method constructor da private olarak tanımlandı 
        private string $action, // Form nesnesinin gönderileceği action sayfası
        private string $method, // Form nesnesinin metot değeri
    ){}

    public static function createPostForm(string $action): Form{ // Bir POST Form nesnesi döndürür
        return Form::createForm($action,  "POST");
    }
    public static function createGetForm(string $action): Form{ // Bir GET Form nesnesi döndürür
        return Form::createForm($action,  "GET");
    }
    public static function createForm(string $action, string $method): Form{ // action ve method parametreli Form nesnesi döndürür
        return new Form($action, $method);
    }

    public function addField(string $label , string $name, ?string $defaultValue = null ): void{ // label , name ve varsa value değerlerini fields dizisine ekler 
        $this->fields[] = array(
                "label" => $label, 
                "name" => $name, 
                "defaultValue" => $defaultValue
            );
       

    }
    public function  setMethod(string $method) : void{ // Geçerli Form nesnesinde method tipini değiştirir
        $this-> method = $method;
    }
    public function  render() : void{ // Bir html form alanı render eder 
            
            echo "<form method =$this->method action = $this->action >" . PHP_EOL;

            foreach($this->fields as $field){
                
                echo "<label for =$field[name]>$field[label]</label>" . PHP_EOL;
                echo "<input type ='text' name =$field[name]  value=";
                if(!is_null($field['defaultValue'])) echo $field['defaultValue']; 
                echo ">" . PHP_EOL;
                
            }

            echo "<button type ='submit'>Gönder</button>";
            echo "</form>";

        }
}