<?php

trait Hello {
    public function sayHello() {
        echo "Olá";
    }
}

trait World {
    public function sayWorld() {
        echo "Mundo";
    }
}

class View {
    use Hello, World;
}

$view = new View();
$view->sayHello();
$view->sayWorld();
// exibe: Olá Mundo

?>


<?php
final class ClasseBase {
   public function teste() {
       echo "ClasseBase::teste() chamado\n";
   }
   
   final public function maisTeste() {
       echo "ClasseBase::maisTeste() chamado\n";
   }
}

class ClasseFilha extends ClasseBase {
   
}
?>
