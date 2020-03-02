    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Print a Label</title> 
    <script src = "http://labelwriter.com/software/dls/sdk/js/DYMO.Label.Framework.latest.js" type="text/javascript" charset="UTF-8"> </script>
    <script src = "../js/PrintLabel.js" type="text/javascript" charset="UTF-8"> </script>
    </head>

    <body>
    <h2>Lab Label</h2> 

        <div id="textDiv">
           <label for="textTextArea">Label :</label><br/> 
 <textarea name="textTextArea" id="textTextArea"  rows='7' cols='20'> <?php echo "LUAN CAMPOS 
 CARGO 
 ALGORITECH" . "&#160;&#160;&#160;&#160;&#160;&#160;" .$oid."\n"; ?>
 &nbsp;
 
 </textarea></div>
    
      

            </textarea>
&nbsp;
       <div> <input type="text" id="barCode" value="12345678909876">
    </div>

            <div id="printDiv">
                <button id="printButton">Imprimir Codigo</button>
            </div>

    </body> 

    </html>