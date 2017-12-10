<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use Symfony\Component\Translation\Translator;

class TranslationDemoAction
{
    /** @var Translator */
    private $translator;

    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write($this->translator->trans('pear'));

        return $response;
    }
}
