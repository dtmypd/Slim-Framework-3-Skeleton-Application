<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Response;
use Symfony\Component\Translation\Translator;

class TranslationDemoAction
{
    /**
     * @param Response   $response
     * @param Translator $translator
     *
     * @return Response
     */
    public function __invoke(Response $response, Translator $translator): Response
    {
        // default language
        $response->getBody()->write($translator->trans('pear'));

        // custom language
        $translator->setLocale('hu_HU');
        $response->getBody()->write($translator->trans('pear'));

        return $response;
    }
}
