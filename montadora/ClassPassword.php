<?php 

namespace Classes;

Class ClassPassword{

    #Criar o hash da senha para salvar no db
    public function password_hash($senha)
    {

        return password_hash($senha, algo: PASSWORD_DEFAULT);
    }
}

?>



