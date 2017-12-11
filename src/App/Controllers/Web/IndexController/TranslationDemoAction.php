<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use Symfony\Component\Translation\Translator;

class TranslationDemoAction
{
    /**
     * @param Request    $request
     * @param Response   $response
     * @param Translator $translator
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, Translator $translator): Response
    {
        // default language
        $response->getBody()->write($translator->trans('pear'));

        // custom language
        $translator->setLocale('hu_HU');
        $response->getBody()->write($translator->trans('pear'));

        return $response;
    }
}
