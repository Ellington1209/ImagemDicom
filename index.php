<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Série de Imagens DICOM</title>

    <!-- Incluindo o CSS e o JS do Papaya que estão localmente -->
    <link rel="stylesheet" href="./assets/papaya.css">
    <script src="./assets/papaya.js"></script>

    <script type="text/javascript">
        var params = [];
        params["images"] = [
            <?php
            // Caminho para a pasta onde estão as imagens DICOM
            $directory = './assets/FAD5612F/';
            
            // Inicializando um array vazio para armazenar os caminhos das imagens
            $imageFiles = [];

            // Verificando se o diretório existe e abrindo ele
            if (is_dir($directory)) {
                // Abrindo o diretório
                if ($dh = opendir($directory)) {
                    // Percorrendo cada arquivo dentro do diretório
                    while (($file = readdir($dh)) !== false) {
                        // Ignorando "." e ".."
                        if ($file != "." && $file != "..") {
                            // Adicionando o caminho do arquivo ao array
                            $imageFiles[] = '"' . $directory . $file . '"';
                        }
                    }
                    // Fechando o diretório
                    closedir($dh);
                }
            }

            // Exibindo o array como uma matriz JavaScript
            echo '[' . implode(",", $imageFiles) . ']';
            ?>
        ];
        params["kioskMode"] = true;  // Exibir orientação
    </script>
</head>
<body>
    <!-- Container para o visualizador Papaya com parâmetros -->
    <div class="papaya" data-params="params"></div>

    <!-- Div para exibir informações DICOM (nome do paciente, etc.) -->
    <div id="dicomInfo" style="margin-top: 20px; font-weight: bold;"></div>

    <script>
        // Iniciar o visualizador Papaya
        window.onload = function() {
            papaya.Container.startPapaya();
        };
    </script>
</body>
</html>
