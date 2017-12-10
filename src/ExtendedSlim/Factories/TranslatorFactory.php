<?php namespace ExtendedSlim\Factories;

use Exception;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\Loader\PoFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorFactory
{
    /**
     * @return Translator
     * @throws Exception
     */
    public function create()
    {
        $fileFormat = env('TRANSLATION_FORMAT');
        $languages  = explode(',', env('TRANSLATION_LANGUAGES'));
        $path       = __DIR__ . '/../../../resources/translations/'; // @todo: find better way

        $translator = new Translator('hu_HU'); // @todo: get from config
        $translator->addLoader($fileFormat, $this->getLoader($fileFormat));
        foreach ($languages as $language)
        {
            $translator->addResource($fileFormat, $path . $language . '.' . $fileFormat, $language);
        }

        return $translator;
    }

    /**
     * @param string $translationFileFormat
     *
     * @return LoaderInterface
     * @throws Exception
     */
    private function getLoader(string $translationFileFormat)
    {
        switch ($translationFileFormat)
        {
            case 'po':
                return new PoFileLoader();
            case 'array':
                return new ArrayLoader();
            default:
                throw new Exception(sprintf('Missing translation loader: %s', $translationFileFormat));
        }
    }
}
