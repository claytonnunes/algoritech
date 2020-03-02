 (function()
    {
        // called when the document completly loaded
        function onload()
        {
            var textTextArea = document.getElementById('textTextArea');
            var barCode = document.getElementById('barCode');       
            var printButton = document.getElementById('printButton');

            // prints the label
            printButton.onclick = function()
            {
                try
                {
                    // open label
                    var labelXml = '<?xml version="1.0" encoding="utf-8"?>\
        <DieCutLabel Version="8.0" Units="twips">\
            <PaperOrientation>Landscape</PaperOrientation>\
            <Id>Text</Id>\
            <PaperName>30252 Address</PaperName>\
            <DrawCommands/>\
            <ObjectInfo>\
                <TextObject>\
                    <Name>Text</Name>\
                    <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />\
                    <BackColor Alpha="0" Red="255" Green="255" Blue="255" />\
                    <LinkedObjectName></LinkedObjectName>\
                    <Rotation>Rotation0</Rotation>\
                    <IsMirrored>False</IsMirrored>\
                    <IsVariable>True</IsVariable>\
                    <HorizontalAlignment>Left</HorizontalAlignment>\
                    <VerticalAlignment>Middle</VerticalAlignment>\
                    <TextFitMode>ShrinkToFit</TextFitMode>\
                    <UseFullFontHeight>True</UseFullFontHeight>\
                    <Verticalized>False</Verticalized>\
                    <StyledText/>\
                </TextObject>\
                <Bounds X="332" Y="150" Width="4455" Height="1260" />\
            </ObjectInfo>\
            <ObjectInfo>\
             <BarcodeObject>\
                 <Name>Barcode</Name>\
                 <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />\
                 <BackColor Alpha="0" Red="255" Green="255" Blue="255" />\
                 <LinkedObjectName>BarcodeText</LinkedObjectName>\
                 <Rotation>Rotation0</Rotation>\
                 <IsMirrored>False</IsMirrored>\
                 <IsVariable>True</IsVariable>\
                 <Text>barCode</Text>\
                 <Type>Code128Auto</Type>\
                 <Size>Medium</Size>\
                 <TextPosition>Bottom</TextPosition>\
                 <TextFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />\
                 <CheckSumFont Family="Arial" Size="8" Bold="False" Italic="False" Underline="False" Strikeout="False" />\
                 <TextEmbedding>None</TextEmbedding>\
                 <ECLevel>0</ECLevel>\
                 <HorizontalAlignment>Center</HorizontalAlignment>\
                 <QuietZonesPadding Left="0" Top="0" Right="2" Bottom="0" />\
             </BarcodeObject>\
             <Bounds X="324" Y="950" Width="3150" Height="520" />\
         </ObjectInfo>\
        </DieCutLabel>';
                    var label = dymo.label.framework.openLabelXml(labelXml);

                    // set label text
                    label.setObjectText("Text", textTextArea.value);
                    label.setObjectText('Barcode', barCode.value);                
                    // select printer to print on
                    // for simplicity sake just use the first LabelWriter printer
                    var printers = dymo.label.framework.getPrinters();
                    if (printers.length == 0)
                        throw "No DYMO printers are installed. Install DYMO printers.";

                    var printerName = "";
                    for (var i = 0; i < printers.length; ++i)
                    {
                        var printer = printers[i];
                        if (printer.printerType == "LabelWriterPrinter")
                        {
                            printerName = printer.name;
                            break;
                        }
                    }

                    if (printerName == "")
                        throw "No LabelWriter printers found. Install LabelWriter printer";

                    // finally print the label
                    label.print(printerName);
                }
                catch(e)
                {
                    alert(e.message || e);
                }
            }
        };

        // register onload event
        if (window.addEventListener)
            window.addEventListener("load", onload, false);
        else if (window.attachEvent)
            window.attachEvent("onload", onload);
        else
            window.onload = onload;

    } ());