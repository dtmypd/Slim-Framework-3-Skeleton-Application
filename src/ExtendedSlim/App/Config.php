<?php namespace ExtendedSlim\App;

use Dotenv\Dotenv;

class Config
{
    /**
     * @param string $manualDotenvFile
     *
     * @return void
     */
    public function envSetup($manualDotenvFile = '')
    {
        $dotenvFile = empty($manualDotenvFile) ? $this->getDotenvFile() : $manualDotenvFile;

        (new Dotenv(__DIR__ . '/../../../', $dotenvFile))->load(); //@todo: find better solution
    }

    /**
     * @return string
     */
    private function getDotenvFile()
    {
        return false !== getenv('DOTENV_FILE') ? getenv('DOTENV_FILE') : '.env';
    }
}
