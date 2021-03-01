<?php
/**
 * Author: João Leno
 * Date: 01/03/2021
 * E-mail: joaolenosi@gmail.com
 */
//obtém o path completo da pasta que deseja compactar
$rootPath = realpath('backup_database/');
$zip      = new ZipArchive();
//Cria ou sobrescrever o arquivo .zip com a data atual
$zip->open(date('d-m-Y').'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

//Cria um array com os arquivos da pasta
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);
 
foreach ($files as $name => $file){
    //Se o elemento interado não for um diretório, então adiciona pra o arquivo .zip
    if (!$file->isDir()){
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        //Adiciona o arquivo interado para o .zip passando como segundo parâmetro o relativo path
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();
?>
