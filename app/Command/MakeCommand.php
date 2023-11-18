<?php

class MakeCommand
{
    public function run($arguments)
    {
        $command = isset($arguments[0]) ? $arguments[0] : '';

        switch ($command) {
            case 'model':
                $this->makeModel($arguments);
                break;
            case 'controller':
                $this->makeController($arguments);
                break;
            default:
                output("❌ Command not found: {$command}\n", "red");
        }
    }

    protected function makeModel($arguments)
    {
        $yellow = "\033[1;33m";
        $blue = "\033[0;34m";
        $table = $arguments[1];
        $fileName = ucfirst(rtrim($table, "s"));

        output("Creating model... \n", "blue");

        try {
            $templatePath = __DIR__ . '/templates';
            $fileGenerator = new FileGenerator($templatePath);

            $templateFile = "ModelTemplate";
            $outputFileName = "{$fileName}.php";
            $outputPath = __DIR__ . "/../Model/{$outputFileName}";


            if (file_exists($outputPath)) {
                output("❓ Model file already exists. Do you want to overwrite it? (y/n): ", "yellow");
                $confirmation = trim(fgets(STDIN));

                if (strtolower($confirmation) !== 'y') {
                    output("❌ Model creation aborted.\n", "red");
                    return;
                }
            }

            $placeholders = [
                'class' => $fileName,
                'table' => $table,
            ];

            $fileGenerator->createFile($templateFile, $outputPath, $placeholders);

            output("✔ Model {$yellow}\"{$fileName}\"{$blue} created successfully at: {$yellow}" . realpath($outputPath) . "\n", "blue");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }


    protected function makeController($arguments)
    {
        $yellow = "\033[1;33m";
        $blue = "\033[0;34m";
        $argsLow = rtrim($arguments[1], "s");
        $argsUp = ucfirst($argsLow);

        output("Creating controller... \n", "blue");

        try {
            $templatePath = __DIR__ . '/templates';
            $fileGenerator = new FileGenerator($templatePath);

            $templateFile = "ControllerTemplate";
            $outputFileName = "{$argsUp}Controller.php";
            $outputPath = __DIR__ . "/../Controller/{$outputFileName}";


            if (file_exists($outputPath)) {
                output("❓ Controller file already exists. Do you want to overwrite it? (y/n): ", "yellow");
                $confirmation = trim(fgets(STDIN));

                if (strtolower($confirmation) !== 'y') {
                    output("❌ Controller creation aborted.\n", "red");
                    return;
                }
            }

            $placeholders = [
                'argsLow' => $argsLow,
                'argsUp' => $argsUp,
            ];

            $fileGenerator->createFile($templateFile, $outputPath, $placeholders);

            output("✔ Controller {$yellow}\"{$argsUp}\"{$blue} created successfully at: {$yellow}" . realpath($outputPath) . "\n", "blue");
        } catch (\PDOException $e) {
            output("❌ Error: " . $e->getMessage(), "red");
        }
    }
}

class FileGenerator
{
    protected $templatePath;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function createFile($fileName, $outputPath, $placeholders = [])
    {
        $templateContent = $this->loadTemplate($fileName);
        $filledContent = $this->fillPlaceholders($templateContent, $placeholders);
        file_put_contents($outputPath, $filledContent);
    }

    public function loadTemplate($fileName)
    {
        $templateFile = $this->templatePath . DIRECTORY_SEPARATOR . $fileName;
        if (file_exists($templateFile)) {
            return file_get_contents($templateFile);
        } else {
            throw new Exception("Template file not found: {$templateFile}");
        }
    }

    protected function fillPlaceholders($content, $placeholders)
    {
        foreach ($placeholders as $placeholder => $value) {
            $content = str_replace("{{{$placeholder}}}", $value, $content);
        }
        return $content;
    }
}
