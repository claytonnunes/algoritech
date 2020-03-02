<?php  
$connect = mysqli_connect("localhost", "root", "Blaster631xd", "gestor_evento");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name = mysqli_real_escape_string($connect, $_POST["nome_produto"]);  
      $address = mysqli_real_escape_string($connect, $_POST["descricao"]);  
      $gender = mysqli_real_escape_string($connect, $_POST["id_categoria"]);  
      $designation = mysqli_real_escape_string($connect, $_POST["medida"]);  
      $age = mysqli_real_escape_string($connect, $_POST["valor_locacao"]);  
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE produto   
           SET nome_produto='$name',   
           descricao='$address',   
           id_categoria='$gender',   
           medida = '$designation',   
           valor_locacao = '$age'   
           WHERE id='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO produto(nome_produto, descricao, id_categoria, medida, valor_locacao)  
           VALUES('$name', '$address', '$gender', '$designation', '$age');  
           ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM produto ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Employee Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["nome_produto"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>